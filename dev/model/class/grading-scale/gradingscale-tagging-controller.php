<?php
session_start();
include '../../configuration/connection-config.php';

if( isset($_POST['subjid'])
        && isset($_POST['gscaleid'])){

        $gscaleid = $_POST['gscaleid'];
        $subjid = $_POST['subjid'];

    if( $subjid !== ""
        && $gscaleid !== ""){
        
        for($i = 0; $i<count($subjid); $i++){
            $subjidtag = $subjid[$i];

            $sql2 = "DELETE FROM `schoolacademicgradingscalesubject` WHERE `SchlEnrollSubjOff_ID` = '$subjidtag' OR SchlAcadGradScale_ID = '$gscaleid';";
            
            if(mysqli_query($dbConn, $sql2)){

            } else {
                echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
            }
        }

        for($j = 0; $j<count($subjid); $j++){
            $subjidtag = $subjid[$j];

            $sql = "INSERT INTO schoolacademicgradingscalesubject (SchlAcadGradScaleSubj_STATUS, 
                            SchlAcadGradScaleSubj_ISACTIVE, 
                            SchlAcadGradScale_ID, 
                            SchlEnrollSubjOff_ID)
                    VALUES (1, 
                            1, 
                            '$gscaleid', 
                            '$subjidtag')";
            
            if(mysqli_query($dbConn, $sql)){

            } else {
                echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
            }
        }
        
    } else {
        echo '<script>alert("ERROR: Blank input detected.")</script>';
    }
    
} else {
    echo '<script>alert("Variables are not set.")</script>';
}

$dbConn->close();
?>