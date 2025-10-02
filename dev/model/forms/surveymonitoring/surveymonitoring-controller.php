<?php
	session_start();
	include_once '../../configuration/connection-config.php';

	if(isset($_GET['type'])){
		if ($_GET['type'] == 'ACADLEVEL'){
			$qry = "SELECT DISTINCT `form`.`SchlAcadLvl_ID` `ID`,
                        `level`.`SchlAcadLvl_NAME` `NAME`
                    
                    FROM `school".$_GET['formtype']."information` `form`
                    
                    LEFT JOIN `schoolacademiclevel` `level`
                    ON `form`.`SchlAcadLvl_ID` = `level`.`SchlAcadLvlSms_ID`

					WHERE `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
					AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1
					AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
                    
                    ORDER BY `NAME` DESC;
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADYEAR'){
			$qry = "SELECT DISTINCT `form`.`SchlAcadYr_ID` `ID`,
                        `year`.`SchlAcadYr_NAME` `NAME`
                    
                    FROM `school".$_GET['formtype']."information` `form`
                    
                    LEFT JOIN `schoolacademicyear` `year`
                    ON `form`.`SchlAcadYr_ID` = `year`.`SchlAcadYrSms_ID`
                    
                    WHERE `form`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
					AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
					AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1
					AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
                    
                    ORDER BY `ID` DESC
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADPERIOD'){
			$qry = "SELECT DISTINCT `form`.`SchlAcadPrd_ID` `ID`,
                        `period`.`SchlAcadPrd_NAME` `NAME`
                    
                    FROM `school".$_GET['formtype']."information` `form`
                    
                    LEFT JOIN `schoolacademicperiod` `period`
                    ON `form`.`SchlAcadPrd_ID` = `period`.`SchlAcadPrdSms_ID`
					
                    WHERE `form`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
	                    AND `form`.`SchlAcadYr_ID` = ".$_GET['yearid']."
	                    AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
                        AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1
                        AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
                    
                    ORDER BY `ID` DESC
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'FORM'){
			$qry = "SELECT DISTINCT `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ID` `ID`,
                        `form`.`Schl" . $_GET['formtype_abbr'] . "Info_NAME` `NAME`
                        
                        FROM `school".$_GET['formtype']."information` `form`
	
                    WHERE `form`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
	                    AND `form`.`SchlAcadYr_ID` = ".$_GET['yearid']."
                        AND `form`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
                        AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
                        AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1
                        AND `form`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
                    
                    ORDER BY `ID` DESC
            ";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SEARCH'){
			$qry = "SELECT 
						`sec`.`SchlAcadSecSms_ID` AS `SEC_ID`,
						`sec`.`SchlAcadSec_NAME` AS `NAME`,
						`crse`.`SchlAcadCrses_NAME` AS `CRSE`,
						`yearlevel`.`SchlAcadYrLvl_NAME` AS` YEARLEVEL`,
						COUNT(*) AS `TOTAL_ENROLLED`,
						SUM(CASE WHEN `info`.`SchlEnrollRegStudInfo_GENDER` = 'FEMALE' THEN 1 ELSE 0 END) AS `FEMALE`,
						SUM(CASE WHEN `info`.`SchlEnrollRegStudInfo_GENDER` = 'MALE' THEN 1 ELSE 0 END) AS `MALE`
					FROM `schoolenrollmentassessment` `ass`
					
					LEFT JOIN `schoolacademicsection` `sec`
					ON `ass`.`SchlAcadSec_ID` = `sec`.`SchlAcadSecSms_ID`
					LEFT JOIN `schoolacademiccourses` `crse`
					ON `ass`.`SchlAcadCrse_ID` = `crse`.`SchlAcadCrseSms_ID`
					LEFT JOIN `schoolacademicyearlevel` `yearlevel`
					ON `ass`.`SchlAcadYrLvl_ID` = `yearlevel`.`SchlAcadYrLvlSms_ID`
					LEFT JOIN `schoolenrollmentadmission` `adm`
					ON `adm`.`SchlEnrollAdmSms_ID` = `ass`.`SchlEnrollAdm_ID`
					LEFT JOIN `schoolenrollmentregistrationstudentinformation` `info`
					ON `info`.`SchlEnrollReg_ID` = `adm`.`SchlEnrollReg_ID`
                    
                    WHERE `ass`.`SchlAcadSec_ID` IS NOT NULL
                    AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
                    AND `ass`.`SchlAcadYr_ID` = ".$_GET['yearid']."
                    AND `ass`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
                    AND `ass`.`SchlEnrollAss_STATUS` = 1
                    AND IFNULL(`ass`.`SchlEnrollWithdrawType_ID`, '0') = 0
                    
					GROUP BY SEC_ID, NAME, CRSE, YEARLEVEL
					ORDER BY CRSE, YEARLEVEL ASC;
						";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SEARCH_EVALUATION_ANSWERED'){
			$qry = "SELECT 
						`SEC_ID`,
						COUNT(*) AS `ANSWERED_COUNT`
					FROM (
						SELECT 
							`ans`.`SchlStud_ID`,
							`ass`.`SchlAcadSec_ID` AS `SEC_ID`,
							(LENGTH(`ass`.`SchlAcadSubj_ID`) - LENGTH(REPLACE(`ass`.`SchlAcadSubj_ID`, ',', '')) + 1) AS `SUBJ_COUNT`,
							COUNT(*) AS `ANSWER_COUNT`
					
						FROM `school" . $_GET['formtype'] . "information` `eval_info`
					
						LEFT JOIN `school" . $_GET['formtype'] . "answer` `ans`
							ON `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ID` = `ans`.`Schl" . $_GET['formtype_abbr'] . "Info_ID`
						LEFT JOIN `schoolenrollmentregistration` `reg`
							ON `ans`.`SchlEnrollReg_ID` = `reg`.`SchlEnrollRegSms_ID`
						LEFT JOIN `schoolenrollmentadmission` `adm`
							ON `reg`.`SchlEnrollRegSms_ID` = `adm`.`SchlEnrollReg_ID`
						LEFT JOIN `schoolenrollmentassessment` `ass`
							ON `adm`.`SchlEnrollAdmSms_ID` = `ass`.`SchlEnrollAdm_ID`
					
						WHERE 
							`eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
							AND `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1 
							AND `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
							AND `eval_info`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
							AND `eval_info`.`SchlAcadYr_ID` = ".$_GET['yearid']."
							AND `eval_info`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
							
						GROUP BY `ans`.`SchlStud_ID`, `ass`.`SchlAcadSec_ID`
						-- 
						HAVING `SUBJ_COUNT` = `ANSWER_COUNT`
					) AS Subquery
					GROUP BY `SEC_ID`;
						";
						// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
						// echo var_dump($qry);
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SEARCH_SURVEY_ANSWERED'){
			$qry = "SELECT 
						`SEC_ID`,
						COUNT(*) AS `ANSWERED_COUNT`
					FROM (
						SELECT 
							`ans`.`SchlStud_ID`,
							`ass`.`SchlAcadSec_ID` AS `SEC_ID`,
							(LENGTH(`ass`.`SchlAcadSubj_ID`) - LENGTH(REPLACE(`ass`.`SchlAcadSubj_ID`, ',', '')) + 1) AS `SUBJ_COUNT`,
							COUNT(*) AS `ANSWER_COUNT`
					
						FROM `school" . $_GET['formtype'] . "information` `eval_info`
					
						LEFT JOIN `school" . $_GET['formtype'] . "answer` `ans`
							ON `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ID` = `ans`.`Schl" . $_GET['formtype_abbr'] . "Info_ID`
						LEFT JOIN `schoolenrollmentregistration` `reg`
							ON `ans`.`SchlEnrollReg_ID` = `reg`.`SchlEnrollRegSms_ID`
						LEFT JOIN `schoolenrollmentadmission` `adm`
							ON `reg`.`SchlEnrollRegSms_ID` = `adm`.`SchlEnrollReg_ID`
						LEFT JOIN `schoolenrollmentassessment` `ass`
							ON `adm`.`SchlEnrollAdmSms_ID` = `ass`.`SchlEnrollAdm_ID`
					
						WHERE 
							`eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_STATUS` = 1
							AND `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ISACTIVE` = 1 
							AND `eval_info`.`Schl" . $_GET['formtype_abbr'] . "Info_ISOPEN` = 1
							AND `eval_info`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
							AND `eval_info`.`SchlAcadYr_ID` = ".$_GET['yearid']."
							AND `eval_info`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
							
						GROUP BY `ans`.`SchlStud_ID`, `ass`.`SchlAcadSec_ID`
					) AS Subquery
					GROUP BY `SEC_ID`;
						";
						
		// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
		// echo var_dump($qry);
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else {
			echo '<script>alert("POST CHANGED. CONTACT ICT DEPARTMENT")</script>';
		}
		
	} else {
    	echo '<script>alert("POST NOT SET. CONTACT ICT DEPARTMENT")</script>';
	}

	$rsreg->free_result();
	$dbConn->close();
	echo json_encode($fetch);
?>