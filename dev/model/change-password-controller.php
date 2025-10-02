<?php
    
    if(empty($_POST)){
        http_response_code(404);
        exit;
    }

    // PHP error handling
    // ini_set('display_errors', 0);
    // ini_set('log_errors', 1);

    function isValidToken($token) {
        return is_string($token) && preg_match('/^[a-f0-9]{64}$/', $token);
    }

    require_once 'configuration/connection-config.php';

    try {
        // === 1. Validate token ===
        $token = isValidToken($_POST['token']) ? htmlspecialchars($_POST['token'], ENT_QUOTES, 'UTF-8') : throw new Exception("Invalid token.");

        $stmt = $dbConn->prepare("SELECT `SysUserRstTkn_Email`, `SysUserRstTkn_UserType` FROM `systemuser_reset_tokens` tkn WHERE tkn.`SysUserRstTkn_Token` = ?;");
        $stmt->bind_param('s', $token);
        $stmt->execute();
                
        $stmt->bind_result($email, $usertype);
        if (!$stmt->fetch()) { throw new Exception("Invalid token."); }
        $stmt->close();

        // === 2. Encrypt password ===
        $password = trim($_POST['password']);
        $password_hashed = $password ? password_hash($password, PASSWORD_ARGON2ID, $options) : exit('Missing Post');

        // === 3. Delete token from db ===
        $stmt = $dbConn->prepare("DELETE FROM `schoolportal_fcpc_edu_ph`.`systemuser_reset_tokens` WHERE `SysUserRstTkn_Token` = ?;");

        $stmt->bind_param('s', $token);
        $stmt->execute();
        $stmt->close();

        // === 4. Update password ===
        $usertype = intval($usertype);

        $stmt = $dbConn->prepare("UPDATE `schoolportal_fcpc_edu_ph`.`systemuser` SET `SysUser_PASSWORD` = ?
            WHERE `SysUser_USERNAME` = ? AND `SysUserType_ID` = ? ;");

        $stmt->bind_param('ssi', $password_hashed, $email, $usertype);
        $stmt->execute();
        
        // === 5. Return Success ===
        if($stmt->affected_rows == 1){ 
            echo json_encode([["status" => "SUCCESS", "email" => $email, "password" => $password]]);
        } else {
            echo json_encode(array('error'=>'An error occurred. Please contact the ICT Department promptly.'));
        }

        $stmt->close();
        
    } catch (Throwable $e) {
        // Don't echo raw error to the browser
        // You can log it instead: error_log($e->getMessage());
        error_log($e->getMessage());
        exit(json_encode(array('error'=>'An error occurred. Please try again later.')));
    }
?>