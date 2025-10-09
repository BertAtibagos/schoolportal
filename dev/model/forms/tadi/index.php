<?php 
    session_start();
    
    // var_dump($_SESSION);

    if($_SESSION['USERTYPE'] == 'STUDENT'){
        include_once 'student/index.php';
    }

    if($_SESSION['USERTYPE'] == 'EMPLOYEE'){
        include_once 'prof/index.php';
        // $priv = $_SESSION['PRIVILEGES'] ?? '';
    
        // if(str_contains($priv, 'GRADING SCALE') || str_contains($_SESSION['USERACCESSRIGHTS'], 'mnu-grading-scale')){
        //     include_once 'dean/index.php';
        // } else {
            
        // }
    }


?>


<div style="margin-bottom: 5rem;">

</div>