<?php
    if(empty($_GET['token'])){
        http_response_code(404);
        exit;
    }

    // PHP error handling
    // ini_set('display_errors', 0);
    // ini_set('log_errors', 1);

	require_once 'configuration/connection-config.php';

    // === 1. Check Token Validity ===
    function isValidToken($token) {
        return is_string($token) && preg_match('/^[a-f0-9]{64}$/', $token);
    }

    $token = isValidToken($_GET['token']) ? htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8') : die('Invalid token.');
    
    // === 2. Check Token Existence ===
    $stmt = $dbConn->prepare("SELECT `SysUserRstTkn_Email`, `SysUserRstTkn_Expiration` FROM `systemuser_reset_tokens` tkn WHERE tkn.`SysUserRstTkn_Token` = ?;");
    
    $stmt->bind_param('s', $token);
    $stmt->execute();
            
    $stmt->bind_result($email, $expiry);
    if ($stmt->fetch()) {
        if (strtotime($expiry) < time()) {
            exit('Link expired.');
        }
    } else {
        exit('Invalid token.');
    }

    $stmt->close();
    // echo $email, $expiry;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FCPC School Portal</title> 
	<link rel="icon" href="../images/fcpc_logo.ico" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap-5.2.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/custom/change-password-style.css?t=<?php echo time(); ?>"/>
	<script type="text/javascript" src= "../css/bootstrap/bootstrap-5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body data-token="<?php echo $token; ?>">
    <div class="div-container" id="divChange">
        <div class="alert alert-danger alert-dismissible fade d-none" role="alert" id="errorcontainer">
            <p id="errormessage">Content</p>
            <button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <h3>Create new password</h3>
        <p class="">You password must contain at least eight (8) characters, it must also include at least one (1) number and one (1) special character.</p>

        <form autocomplete="off">
            <div class="col-auto">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" aria-describedby="view-pass" placeholder="•••••••">
                    <button class="btn btn-outline-secondary" type="button" id="view-pass"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
            <div class="form-text text-danger" id="passlength"><i class="fa-solid fa-xmark"></i> at least eight (8) characters</div>
            <div class="form-text text-danger" id="passnum"><i class="fa-solid fa-xmark"></i> one (1) number</div>
            <div class="form-text text-danger" id="passchar"><i class="fa-solid fa-xmark"></i> one (1) special character</div>

            <div class="col-auto mt-4">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirm_password" aria-describedby="view-confpass" placeholder="•••••••">
                    <button class="btn btn-outline-secondary" type="button" id="view-confpass"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
            <div class="form-text text-danger" id="passmatch"><i class="fa-solid fa-xmark"></i> Password match</div>

        </form>
    
        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-outline-secondary w-100" id="btnCancel">Cancel</button>
            </div>
            <div class="col">
                <button class="btn btn-primary w-100" id="btnSubmit">Submit</button>
            </div>
        </div>
    </div>
    
    <div class="div-container" id="divView" style="display: none;">
        <h3 class="text-center text-success">Success!</h3>
        <p class="text-center">Your password has been changed successfully.</p>

        <form autocomplete="off">
            <div class="m-auto mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="e.g firstname.lastname@fcpc.edu.ph" disabled>
            </div>

            <div class="m-auto">
                <label for="new_password">New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password" aria-describedby="view-newpass" placeholder="•••••••" disabled>
                    <button class="btn btn-outline-secondary" type="button" id="view-newpass"><i class="fa-solid fa-eye"></i></button>
                    <button class="btn btn-outline-primary" type="button" id="copy-newpass"><i class="fa-regular fa-clipboard"></i></button>
                </div>
                <div class="form-text text-success text-end d-none copy-text"><i class="fa-regular fa-copy"></i> Copied to clipboard</div>
            </div>
            <div class="text-center mt-4">
                <a href="https://schoolportal.fcpc.edu.ph" target="_blank" class="btn btn-primary w-75" role="button" aria-pressed="true">Go to Login Page <i class="fa-solid fa-circle-arrow-right"></i></a>
            </div>
        </form>
    </div>
</body>
</html>

<script src="../js/custom/change-password-script.js?t=<?php echo time() ?>"></script>