<?php
    session_start();
    include_once '../../configuration/connection-config.php';

    if(isset($_GET['type'])){
        if ($_GET['type'] == 'SURVEY_ANSWER'){
            $qry = "SELECT `surveydet`.`SchlSurveyDet_Record` `RECORD`

                    FROM `schoolsurvey` `survey`
                    
                    LEFT JOIN `schoolsurveydetail` `surveydet`
                    ON `survey`.`SchlSurvey_ID` = `surveydet`.`SchlSurvey_Id`
                    
                    WHERE `survey`.`SchlSurvey_Status` IS NOT NULL
                    AND `survey`.`SchlSurvey_IsActive` = 1
                    AND `surveydet`.`SchlSurveyDet_Status` = 1
                    AND `surveydet`.`SchlSurveyDet_IsActive` = 1
            ";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        } else if ($_GET['type'] == 'YRLVL_ANSWER'){
            $qry = "SELECT `surveydet`.`SchlSurveyDet_Record` `RECORD`,
                        `survey`.`SchlAcadYrlvl_ID` `YRLVL`

                    FROM `schoolsurvey` `survey`
                    
                    LEFT JOIN `schoolsurveydetail` `surveydet`
                    ON `survey`.`SchlSurvey_ID` = `surveydet`.`SchlSurvey_Id`
                    
                    WHERE `survey`.`SchlSurvey_Status` IS NOT NULL
                    AND `survey`.`SchlSurvey_IsActive` = 1
                    AND `surveydet`.`SchlSurveyDet_Status` = 1
                    AND `surveydet`.`SchlSurveyDet_IsActive` = 1
                    ".$_GET['yrlvlid']."
            ";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        } else if ($_GET['type'] == 'STUDENT_LIST_COUNT'){
			$qry = "SELECT
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_1`,':') LIKE '%:1:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C1R1`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_2`,':') LIKE '%:1:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C2R1`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_3`,':') LIKE '%:1:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C3R1`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_4`,':') LIKE '%:1:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C4R1`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_5`,':') LIKE '%:1:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C5R1`,
                        
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_1`,':') LIKE '%:2:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C1R2`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_2`,':') LIKE '%:2:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C2R2`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_3`,':') LIKE '%:2:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C3R2`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_4`,':') LIKE '%:2:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C4R2`,
                        (SELECT COUNT(*)FROM `schoolsurvey` `survey` WHERE CONCAT(`survey`.`SchlSurveyCluster_5`,':') LIKE '%:2:%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid'].") `C5R2`
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);

        } else if ($_GET['type'] == 'STUDENT_LIST'){
			$qry = "SELECT DISTINCT `stud`.`SchlStudSms_ID` `STUD_ID`,
                             `stud`.`SchlStud_NO` `STUD_NO`,
                             TRIM(CONCAT(`info`.`SchlEnrollRegStudInfo_LAST_NAME`, ', ',
                             `info`.`SchlEnrollRegStudInfo_FIRST_NAME`, ' ',
                             `info`.`SchlEnrollRegStudInfo_MIDDLE_NAME`, ' ',
                             `info`.`SchlEnrollRegStudInfo_SUFFIX_NAME`)) `FULL_NAME`,
                             `ass`.`SchlAcadYrLvl_ID` `YRLVL_ID`,
                             `yrlvl`.`SchlAcadYrLvl_NAME` `YRLVL_NAME`,
                             `sec`.`SchlAcadSec_NAME` `SEC_NAME`,
                             `ass`.`SchlAcadSec_ID` `SEC_ID`

                    FROM `schoolsurvey` `survey`

                    LEFT JOIN `schoolstudent` `stud`
                    ON `survey`.`SchlStudSms_ID` = `stud`.`SchlStudSms_ID`
                    LEFT JOIN `schoolenrollmentassessment` `ass`
                    ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
                    LEFT JOIN `schoolacademicyearlevel` `yrlvl`
                    ON `ass`.`SchlAcadYrLvl_ID` = `yrlvl`.`SchlAcadYrLvlSms_ID`
                    LEFT JOIN `schoolenrollmentregistration` `reg`
                    ON `stud`.`SchlEnrollRegColl_ID` = `reg`.`SchlEnrollRegSms_ID`
                    LEFT JOIN `schoolenrollmentregistrationstudentinformation` `info`
                    ON `reg`.`SchlEnrollRegSms_ID` = `info`.`SchlEnrollReg_ID`
                    LEFT JOIN `schoolacademicsection` `sec`
		            ON `ass`.`SchlAcadSec_ID` = `sec`.`SchlAcadSecSms_ID`

                    WHERE CONCAT(`survey`.`SchlSurveyCluster".$_GET['clusterid']."`,':') LIKE '%:".$_GET['clusterval'].":%' AND `survey`.`SchlStudSms_ID` != 0 AND `survey`.`SchlAcadYrlvl_ID` = ".$_GET['yrlvlid']."

                    ORDER BY `SEC_NAME`
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);    
			
		} else if ($_GET['type'] == 'INDIVIDUAL_ANSWER'){
			$qry = "SELECT `surveydet`.`SchlSurveyDet_Record` `RECORDS`,
                        `survey`.`SchlSurveySubmitDate` `SUBMIT_DATE`
		
                    FROM `schoolsurvey` `survey`
                    
                    LEFT JOIN `schoolsurveydetail` `surveydet`
                    ON `survey`.`SchlSurvey_ID` = `surveydet`.`SchlSurvey_Id`
                    
                    WHERE `survey`.`SchlStudSms_ID` = ".$_GET['stud_id']."
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else {
            echo '<script>alert("GET TEXT NOT FOUND. CONTACT ICT DEPARTMENT")</script>';
        }

    } else {
        echo '<script>alert("GET NOT SET. CONTACT ICT DEPARTMENT")</script>';
    }

    $rsreg->free_result();
    $dbConn->close();
    echo json_encode($fetch);
?>