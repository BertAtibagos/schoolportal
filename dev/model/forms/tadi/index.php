<?php 
    session_start();
    
    // var_dump($_SESSION);

    if($_SESSION['USERTYPE'] == 'STUDENT'){
        include_once 'student/index.php';
    }

    if($_SESSION['USERTYPE'] == 'EMPLOYEE'){
        $priv = $_SESSION['PRIVILEGES'] ?? '';
    
        if(str_contains($priv, 'GRADING SCALE') || str_contains($_SESSION['USERACCESSRIGHTS'], 'mnu-grading-scale')){
            include_once 'dean/index.php';
        } else {
            include_once 'prof/index.php';
        }
    }


?>

<div style="margin-bottom: 5rem;">

</div>