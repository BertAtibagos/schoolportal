<?php 
    function validFCPCEmail($str){
        $email = filter_var($str, FILTER_SANITIZE_EMAIL);
        
        if(!str_contains($str, '@')){ 
            return false;
        }

        $user = explode('@', $email)[0];
        $domain = explode('@', $email)[1];

        $domainList = array("fcpc-inc.com", "fcpc.edu.ph");
        // $domainList = array("fcpc.com.ph", "fcpc-inc.com", "fcpc.edu.ph");

        if($domain && in_array($domain, $domainList) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }

        return false;
    }
    // ✅ Secure cookie flags (must be set before session_start)
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_samesite', 'Strict');

    // PHP error handling
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

	if(session_status() === PHP_SESSION_NONE){
		session_start();
	}

	require_once 'configuration/connection-config.php';
    require '../components/vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $type = isset($_POST['type']) ? strtoupper(trim($_POST['type'])) : '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'LOGIN') {
        if (isset($_POST['uemail']) && isset($_POST['upass'])){
            
            // select account using email, return type
            $email = $_POST['uemail'] ? validFCPCEmail($_POST['uemail']) : '';

            if ($email == '' || !$email){
                echo json_encode(array('error' => "Invalid FCPC Email."));
                exit;
            }

            $password = trim($_POST['upass']);
            $password_hashed = $password ? password_hash($password, PASSWORD_ARGON2ID, $options) : exit('Missing Post.');

            $stmt = $dbConn->prepare("SELECT us.`SysUser_PASSWORD` `PASSWORD`, us.`SysUserType_ID` `TYPE` FROM `systemuser` us 
                WHERE us.`SysUser_STATUS` = 1
                AND us.`SysUser_ISACTIVE` = 1
                AND us.`SysUser_USERNAME` = ?;");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            $usertype = 0;
            $userpassword = '';

            while ($row = $result->fetch_assoc()) {
                $passwordIsValid = password_verify($password, $row['PASSWORD']);
                if($passwordIsValid) { 
                    $usertype = intval($row['TYPE']);
                    $userpassword = trim($row['PASSWORD']);
                }
            }

            $stmt->close();

            $status = 0;

            $stmt = $dbConn->prepare("CALL spLOGINsystemuser(?, ?, ?);");
            $stmt->bind_param("ssi", $email, $userpassword, $usertype);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($fetch = $result->fetch_assoc()) {
                $status = intval($fetch["USER_STATUS"]);
                if($status === 1){
                    $_SESSION['USERNAME'] = $fetch['USER_NAME'];
                    $_SESSION['USERINFO'] = $fetch["USER_INFO"];
                    $_SESSION['USERGENDER'] = $fetch['USER_GENDER'];
                    $_SESSION['USERTYPE'] = $fetch['USER_TYPE'];
                    $_SESSION['USERACCESSRIGHTS'] = $fetch['USER_ACSRIGHTS'];
                    $_SESSION['USERID'] = $fetch['USER_ID'];
                    $_SESSION['SYSUSERID'] = $fetch['SYSUSER_ID'];
                    $_SESSION['SYSUSERSMSID'] = $fetch['SYSUSER_SMS_ID'];
                    $_SESSION['USERPICTURE'] = $fetch['USER_PICTURE'];
                    $_SESSION['FINALVAL']= 'home-model.php';
                    $_SESSION['MASTERLABEL'] = 'HOME';
                    $_SESSION['LVLID'] = $fetch['LVL_ID'];
                    $_SESSION['YRID'] = $fetch['YR_ID'];
                    $_SESSION['PRDID'] = $fetch['PRD_ID'];
                    $_SESSION['YRLVLID'] = $fetch['YRLVL_ID'];
                    $_SESSION['CRSEID'] = $fetch['CRSE_ID'];
                    $_SESSION['SECID'] = $fetch['SEC_ID'];
                    $_SESSION['FIRSTNAME'] = $fetch['FIRST_NAME'];
                    $_SESSION['LASTNAME'] = $fetch['LAST_NAME'];
                    $_SESSION['MIDDLENAME'] = $fetch['MIDDLE_NAME'];
                    $_SESSION['SUFFIXNAME'] = $fetch['SUFFIX_NAME'];
                    $_SESSION['EMAILADDRESS'] = $fetch['SYSUSERNAME'];
                    $_SESSION['STUDENT_TYPE'] = 'OLD'; // IF STUDENT IS OLD OR NEW. AUTOMATICALLY IF THEY LOGGED IN, THEY ARE OLD STUDENT.

                    //clearstatcache();
                    //$path = '../images/STUDENT/'.$_SESSION['SYSUSERSMSID'].'/'.$row['USER_PICTURE'];
                    // if (file_exists($_SERVER["DOCUMENT_ROOT"]. '/School_Portal/dev/images/STUDENT/'.$row["SYSUSER_SMS_ID"]'/'.$row["USER_PICTURE"]))
                    // {
                        // $_SESSION['USERPICTURE'] = $row["USER_PICTURE"];
                    // } else {
                    //	 if (STRVAL($row["USER_GENDER"]) == "FEMALE"){
                    //		 $_SESSION['USERPICTURE'] = 'Female.png';
                    //	 | else {
                    //		 $_SESSION['USERPICTURE'] = 'Male.png';
                    //	 }
                    
                    //echo json_encode($fetch);
                    echo json_encode(array('success' => "Login Successful"));
                } else {
                    $value = match($status) {
                        0 => "Invalid username or password.",
                        2 => "This account has been deleted. Please contact the ICT Department promptly.",
                        default => "This account has been disabled. Please contact the ICT Department promptly.",
                    };

                    echo json_encode(array('error' => $value));
                }
            }

            $result->free(); 
            $stmt->close();
            exit;
        } 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type === 'PASSWORD_RESET') {
        if(isset($_POST['email']) && isset($_POST['usertype']) && isset($_POST['g-recaptcha-response'])) {
            // === 1. Validate CAPTCHA ===
            $recaptchaSecret = RECAPTCHA_SECRET;
            $recaptchaResponse = $_POST['g-recaptcha-response'];

            $verifyResponse = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}"
            );
            $responseData = json_decode($verifyResponse);

            if (!$responseData->success) {
                exit(json_encode(array('error'=>'CAPTCHA verification failed.')));
            }

            // === 2. Validate Email and user type ===
            $email = validFCPCEmail(trim($_POST['email']));
            $usertype = trim($_POST['usertype']);
            $map = ['student' => 2, 'instructor' => 1];
            $usertype = $map[strtolower($usertype)] ?? 0;

            if (!$email) { exit(json_encode(array('error'=>"Invalid FCPC Email."))); }

            // === 3. Get and check Attempts ===
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $one_hour_ago = date('Y-m-d H:i:s', strtotime('-1 hour'));
            $stmt = $dbConn->prepare('SELECT COUNT(*) FROM `systemuser_reset_attempts` rst
                WHERE rst.`SysUserRstAtmpt_IP_Address` = ?
                AND rst.`SysUserRstAtmpt_Time` > ?');

            $stmt->bind_param('ss', $ip_address, $one_hour_ago);
            $stmt->execute();
            
            $stmt->bind_result($attempts);
            $stmt->fetch();
            $stmt->close();

            if ($attempts >= 3){
                exit(json_encode(array('error'=>"Too many attempts. Please try again later.")));
            }

            try {
                // === 4. Insert Attempt ===
                $data = [];
                $stmt = $dbConn->prepare("INSERT INTO `schoolportal_fcpc_edu_ph`.`systemuser_reset_attempts` (
                    `SysUserRstAtmpt_IP_Address`,
                    `SysUserRstAtmpt_Time`
                ) VALUES (?, NOW()) ;");
                $stmt->bind_param('s', $ip_address);
                $stmt->execute();
                $stmt->close();

                // === 5. Get user by email ===
                $data = [];
                $stmt = $dbConn->prepare("SELECT us.`SysUser_ID` `ID` FROM `systemuser` us 
                    WHERE us.`SysUser_ISACTIVE` = 1 
                    AND us.`SysUser_STATUS` = 1
                    AND us.`SysUserType_ID` = ?
                    AND us.`SysUser_USERNAME`  = ?;");
                
                $stmt->bind_param('is', $usertype, $email);
                $stmt->execute();
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $token = bin2hex(random_bytes(32));
                    $expires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

                    // === 6. Delete previous tokens ===
                    $stmt = $dbConn->prepare("DELETE FROM
                    `schoolportal_fcpc_edu_ph`.`systemuser_reset_tokens` 
                    WHERE `SysUserRstTkn_Email` = ? AND `SysUserRstTkn_UserType` = ?;");

                    $stmt->bind_param('si', $email, $usertype);
                    $stmt->execute();
                    $stmt->close();
                    
                    // === 7. Insert attempt and token to Db ===
                    $stmt = $dbConn->prepare("INSERT INTO `schoolportal_fcpc_edu_ph`.`systemuser_reset_tokens` (
                        `SysUserRstTkn_Email`,
                        `SysUserRstTkn_UserType`,
                        `SysUserRstTkn_Token`,
                        `SysUserRstTkn_Expiration`
                        ) VALUES (?, ?, ?, ?);");

                    $stmt->bind_param('siss', $email, $usertype, $token, $expires);
                    $stmt->execute();
                    $stmt->close();
                    

                    // === 8. Prepare email variables ===
                    $reset_link = "https://schoolportal.fcpc.edu.ph/model/change-password.php?token=$token";

                    // === 9. Send email na bih ===
                    $mail = new PHPMailer(true);

                    // SMTP Server settings
                    $mail->isSMTP();
                    $mail->Host = SMTP_HOST;
                    $mail->SMTPAuth = true;
                    $mail->Username = SMTP_USER;
                    $mail->Password = SMTP_PASS;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = SMTP_PORT;

                    // Sender and recipient settings
                    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
                    // $mail->addAddress("ramonjoseph.verdon@fcpc-inc.com", "");
                    $mail->addAddress($email, "");

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'FCPC School Portal: Password Reset Request';
                    $mail->Body = "<!DOCTYPE html>
                                    <html> 
                                        <head>
                                            <meta charset='UTF-8'>
                                        </head>
                                        <body style='font-family: Arial, sans-serif;'>
                                            <img width='85'; height='100'; src='https://firebasestorage.googleapis.com/v0/b/emailing-header-footer.appspot.com/o/FCPC-LOGO-2.png?alt=media&token=15f71c79-c5ba-469e-8f67-b5066e07ad1f' alt='FCPC'>
                                            <br>
                                            <p align='justify'>
                                                <p>Hi! 👋</p>

                                                <p>We received a request to reset your password <span role='img' aria-label='key'>🔑</span>.</p>

                                                <p>No worries — you can create a new one by clicking the button below:</p>

                                                <p>
                                                    <a href='$reset_link' 
                                                        class='button'
                                                        style='background-color: #071976; color: #ffffff; padding: 8px 16px; text-decoration: none; border-radius: 6px; display: inline-block;'>
                                                        Reset Password
                                                    </a>
                                                </p>
                                                <p>or</p>
                                                <p>
                                                    Copy and paste this link in your browser: <br>
                                                    <a href='$reset_link' style='color: #071976;' >$reset_link</a>
                                                </p>

                                                <p style='font-size: 14px;'>⏳ This link will expire in <strong>30 minutes</strong> for your security.</p>

                                                <p>🚫 If you did not request a password reset, you can safely ignore this email.</p>

                                                <hr style='margin: 20px 0; border: none; border-top: 1px solid #ddd;'>
                                                
                                                <p style='color: #d93025; font-weight: bold;'>IMPORTANT:</p>
                                                <p style='font-size: 14px;'>
                                                    If this email is in your Spam folder, please mark it as 
                                                    <strong style='color: #071976;'><u>'Not Spam'</u></strong> or 
                                                    <strong style='color: #071976;'><u>'Report as NOT Spam'</u></strong> to ensure you receive future messages. 
                                                </p>

                                                <br>

                                                <p style='font-size: 13px; color: #888; font-style: italic;'>
                                                    ~~ This is an automatically generated email. Please do not reply to this message. ~~
                                                </p>

                                                <p>Best regards,<br><br>
                                                ICT Department<br>
                                                First City Providential College, Inc.</p>
                                            </p>
                                            <br>
                                            <img width='500'; height='85'; src='https://firebasestorage.googleapis.com/v0/b/emailing-header-footer.appspot.com/o/FCPC-Footer.png?alt=media&token=96c33c9b-bb06-4fb0-813b-8760ffd54783' alt='contact'>
                                        </body> 
                                    </html>";

                    // Send the email
                    $isSent = $mail->send();
                    if (!$isSent){
                        throw new Error("Email sending error. Please contact the ICT Department promptly.");
                    }
                } else {
                    throw new Error('Account not found.');
                }
            } catch (Throwable $e) {
                // Don't echo raw error to the browser
                // You can log it instead: error_log($e->getMessage());
                // error_log($e->getMessage());
                exit(json_encode(array('error'=> $e->getMessage() )));
            }

            exit(json_encode(array('success'=>"If this email is registered, you'll receive a reset link shortly.")));
        }

	}
?>
