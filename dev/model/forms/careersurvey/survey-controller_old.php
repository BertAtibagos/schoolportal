<?php
  session_start();
  include_once '../../configuration/connection-config.php';
  // echo '<script>alert("Data Upload to DB Successful!!")</script>';

  if(isset($_GET['type'])){

    if ($_GET['type'] == 'SURVEY_SUBMIT'){
      // echo '<script>alert("'.count($_GET['arr_submit']).'")</script>';

      $arr_submit1 = $_GET['arr_submit'][0];
      $arr_submit2 = $_GET['arr_submit'][1];
      $arr_submit3 = $_GET['arr_submit'][2];
      $arr_submit4 = $_GET['arr_submit'][3];
      $arr_submit5 = $_GET['arr_submit'][4];
      $total_score = $_GET['total_score'];

      $levelid = $_GET['levelid'];
      $yearid = $_GET['yearid'];
      $yearlevelid = $_GET['yearlevelid'];
      $periodid = $_GET['periodid'];
      $courseid = $_GET['courseid'];

      $qry = "INSERT INTO `fcpc_school_portal`.`schoolsurvey` (
                  `SchlStudSms_ID`,
                  `SchlSurveyCluster_1`,
                  `SchlSurveyCluster_2`,
                  `SchlSurveyCluster_3`,
                  `SchlSurveyCluster_4`,
                  `SchlSurveyCluster_5`,
                  `SchlSurveyTotalScore`,
                  `SchlSurveySubmitDate`,
                  `SchlAcadLvl_ID`,
                  `SchlAcadYr_ID`,
                  `SchlAcadYrlvl_ID`,
                  `SchlAcadPrd_ID`,
                  `SchlSurvey_IsActive`,
                  `SchlSurvey_Status`
                ) 
                VALUES
                  (
                    '".$_SESSION['USERID']."',
                    '".$arr_submit1."',
                    '".$arr_submit2."',
                    '".$arr_submit3."',
                    '".$arr_submit4."',
                    '".$arr_submit5."',
                    '".$total_score."',
                    NOW(),
                    '".$levelid."',
                    '".$yearid."',
                    '".$yearlevelid."',
                    '".$periodid."',
                    1,
                    1
                  );
        ";
        
        if(mysqli_query($dbConn, $qry)){
          $last_id = mysqli_insert_id($dbConn);
          // echo '<script>alert("ERROR: Tagging Successful!")</script>';
          $qry2 = "INSERT INTO `schoolsurveydetail` (
                    `SchlSurveyDet_Record`,
                    `SchlSurvey_Id`,
                    `SchlSurveyDet_IsActive`,
                    `SchlSurveyDet_Status`
                  ) 
                  VALUES
                    (
                      '".$_GET['str_chbx']."',
                      '".$last_id."',
                      1,
                      1
                    );
                ";
          if(mysqli_query($dbConn, $qry2)){
            echo '<script>alert("THANK YOU FOR YOUR COOPERATION!")</script>';
          } else {
            echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
          }


        } else {
            echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
        }

    } else if ($_GET['type'] == 'SURVEY_SUBMIT_UPDATE'){
      // echo '<script>alert("'.count($_GET['arr_submit']).'")</script>';

      $arr_submit1 = $_GET['arr_submit'][0];
      $arr_submit2 = $_GET['arr_submit'][1];
      $arr_submit3 = $_GET['arr_submit'][2];
      $arr_submit4 = $_GET['arr_submit'][3];
      $arr_submit5 = $_GET['arr_submit'][4];
      $total_score = $_GET['total_score'];

      $levelid = $_GET['levelid'];
      $yearid = $_GET['yearid'];
      $yearlevelid = $_GET['yearlevelid'];
      $periodid = $_GET['periodid'];
      $courseid = $_GET['courseid'];

      $qry = "UPDATE 
                `fcpc_school_portal`.`schoolsurvey` 
              SET
                `SchlSurveyCluster_1` = '".$arr_submit1."',
                `SchlSurveyCluster_2` = '".$arr_submit2."',
                `SchlSurveyCluster_3` = '".$arr_submit3."',
                `SchlSurveyCluster_4` = '".$arr_submit4."',
                `SchlSurveyCluster_5` = '".$arr_submit5."',
                `SchlSurveyTotalScore` = '".$total_score."',
                `SchlSurveySubmitDate` = NOW(),
                `SchlAcadLvl_ID` = '".$levelid."',
                `SchlAcadYr_ID` = '".$yearid."',
                `SchlAcadYrlvl_ID` = '".$yearlevelid."',
                `SchlAcadPrd_ID` = '".$periodid."',
                `SchlSurvey_IsActive` = 1,
                `SchlSurvey_Status` = 2 
              WHERE 
                `SchlStudSms_ID` = '".$_SESSION['USERID']."' ;
      ";
        
        if(mysqli_query($dbConn, $qry)){
          $last_id = mysqli_insert_id($dbConn);
          $qry2 = "UPDATE 
                    `fcpc_school_portal`.`schoolsurveydetail` 
                  LEFT JOIN `schoolsurvey`
                  ON `schoolsurveydetail`.`SchlSurvey_Id` = `schoolsurvey`.`SchlSurvey_ID`
                  SET
                    `schoolsurveydetail`.`SchlSurveyDet_Record` = '".$_GET['str_chbx']."'
                  WHERE `schoolsurvey`.`SchlStudSms_ID` = '".$_SESSION['USERID']."';      
                ";
          if(mysqli_query($dbConn, $qry2)){
            echo '<script>alert("THANK YOU FOR YOUR COOPERATION!")</script>';
          } else {
            echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
          }


        } else {
            echo '<script>alert("ERROR: Tagging Unsuccessful!")</script>';
        }

    } elseif ($_GET['type'] == 'SURVEY_ANSWER'){
      $qry = "SELECT `surveydet`.`SchlSurveyDet_Record` `SURVEY_RECORD`,
                      `survey`.`SchlStudSms_ID` `STUDID`,
                      `survey`.`SchlAcadYrlvl_ID` `YRLVLID`,
                      `survey`.`SchlAcadLvl_ID` `LVLID`,
                      `survey`.`SchlSurveySubmitDate` `SUBMIT_DATE`,
                      `SchlSurvey_Status` `STATUS`

              FROM `schoolsurvey` `survey`
              
              LEFT JOIN `schoolsurveydetail` `surveydet`
              ON `survey`.`SchlSurvey_ID` = `surveydet`.`SchlSurvey_Id`
              
              WHERE `survey`.`SchlStudSms_ID` = ".$_SESSION['USERID']."
              AND `survey`.`SchlSurvey_IsActive` = 1
      ";
      $rsreg = $dbConn->query($qry);
      $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
      $rsreg->free_result();
      echo json_encode($fetch);

    } else if ($_GET['type'] == 'ONLOAD'){
      $qry = "SELECT DISTINCT `ass`.`SchlAcadLvl_ID` `LVLID`,
                  `ass`.`SchlAcadYr_ID` `YRID`,
                  `ass`.`SchlAcadPrd_ID` `PRDID`,
                  `ass`.`SchlAcadCrse_ID` `CRSEID`,
                  `ass`.`SchlAcadYrlvl_ID` `YRLVLID`
              
              FROM `schoolenrollmentassessment` `ass`
              
              LEFT JOIN `schoolacademiclevel` `lvl`
              ON `ass`.`SchlAcadLvl_ID` = `lvl`.`SchlAcadLvlSms_ID`

              WHERE `ass`.`SchlStud_ID` = ".$_SESSION['USERID']."
              
              ORDER BY `LVLID`,`YRID`,`PRDID`  DESC
              LIMIT 1;
      ";
      $rsreg = $dbConn->query($qry);
      $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
      $rsreg->free_result();
      echo json_encode($fetch);

    } else {
      echo '<script>alert("GET NOT FOUND. CONTACT ICT DEPARTMENT")</script>';
    }

  } else {
    echo '<script>alert("GET NOT SET. CONTACT ICT DEPARTMENT")</script>';
  }

  $dbConn->close();
?>