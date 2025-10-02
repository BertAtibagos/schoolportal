<?php
	session_start();
	include_once '../../../configuration/connection-config.php';
	if(isset($_GET['type']))
    {
		if ($_GET['type'] == 'ACADLEVEL'){
			$qry = "SELECT DISTINCT `crse`.`SchlAcadLvl_ID` `ID`, `level`.`SchlAcadLvl_NAME` `NAME`

			FROM `schooldepartment` `dept`
			
			LEFT JOIN `schoolacademiccourses` `crse`
			ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
			LEFT JOIN `schoolacademiclevel` `level`
			ON `crse`.`SchlAcadLvl_ID` = `level`.`SchlAcadLvlSms_ID`
			
			WHERE `crse`.`SchlAcadCrses_STATUS` = 1 AND `SchlAcadCrses_ISACTIVE` = 1 AND 
				`dept`.`SchlDeptHead_ID` = ". $_SESSION['USERID'] .";";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADYEAR'){
			$qry ="SELECT DISTINCT `year`.`SchlAcadYrSms_ID` `ID`, `year`.`SchlAcadYr_NAME` `NAME`

					FROM `schooldepartment` `dept`

					LEFT JOIN `schoolacademiccourses` `crse`
					ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `suboff`
					ON `crse`.`SchlAcadCrseSms_ID` = `suboff`.`SchlAcadCrses_ID`
					LEFT JOIN `schoolacademicyear` `year`
					ON `suboff`.`SchlAcadYr_ID` = `year`.`SchlAcadYrSms_ID`

					WHERE `crse`.`SchlAcadCrses_STATUS` = 1 AND `SchlAcadCrses_ISACTIVE` = 1 
								AND `dept`.`SchlDeptHead_ID` = ". $_SESSION['USERID'] ." 
								AND `suboff`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ." 
					ORDER BY `year`.`SchlAcadYr_RANKNO` DESC";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);

		} else if ($_GET['type'] == 'ACADPERIOD'){
			$qry = "SELECT DISTINCT `prd`.`SchlAcadPrdSms_ID` `ID`, `prd`.`SchlAcadPrd_NAME` `NAME`

						FROM `schooldepartment` `dept`

						LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
						LEFT JOIN `schoolenrollmentsubjectoffered` `suboff`
						ON `crse`.`SchlAcadCrseSms_ID` = `suboff`.`SchlAcadCrses_ID`
						LEFT JOIN `schoolacademicperiod` `prd`
						ON `suboff`.`SchlAcadPrd_ID` = `prd`.`SchlAcadPrdSms_ID`

						WHERE `crse`.`SchlAcadCrses_STATUS` = 1 AND `SchlAcadCrses_ISACTIVE` = 1
							AND `dept`.`SchlDeptHead_ID` = ". $_SESSION['USERID'] ." 
							AND `suboff`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ." 
							AND `suboff`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
					ORDER BY `prd`.`SchlAcadPrdSms_ID` ASC";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);

		} else if ($_GET['type'] == 'DEPARTMENT'){
			$qry = "SELECT DISTINCT	`dept`.`SchlDeptSms_ID` `ID`, 
									`dept`.`SchlDept_NAME` `NAME`
					FROM `schoolenrollmentsubjectoffered` `subj_off`
						LEFT JOIN `schoolacademiccourses` `crse`
							ON `subj_off`.`schlacadcrses_id` = `crse`.`schlacadcrsesms_id`
						LEFT JOIN `schooldepartment` `dept`
							ON `crse`.`SchlDept_ID` = `dept`.`SchlDeptSms_ID`
					WHERE  	`subj_off`.`schlprof_id` = ". $_SESSION['USERID'] ."
						AND `subj_off`.`schlacadlvl_id` = " .$_GET['levelid'] . " 
						AND `subj_off`.`schlacadyr_id` = " .$_GET['yearid'] . " 
						AND `subj_off`.`SchlAcadPrd_ID` = " .$_GET['periodid'] . " 
						AND `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
						AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					ORDER BY `dept`.`SchlDept_NAME`";
							
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'ACADCOURSE'){
			$qry = "SELECT DISTINCT `dept`.`SchlDeptSms_ID` `DEPT_ID`, 
					`dept`.`SchlDept_NAME` `DEPT_NAME`,
					`crse`.`SchlAcadCrseSms_ID` `ID`, `crse`.`SchlAcadCrses_NAME` `NAME`

					FROM `schooldepartment` `dept`

					LEFT JOIN `schoolacademiccourses` `crse`
					ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `suboff`
					ON `crse`.`SchlAcadCrseSms_ID` = `suboff`.`SchlAcadCrses_ID`
					LEFT JOIN `schoolacademicyear` `year`
					ON `suboff`.`SchlAcadYr_ID` = `year`.`SchlAcadYrSms_ID`

					WHERE 
					-- `crse`.`SchlAcadCrses_STATUS` = 1 AND `SchlAcadCrses_ISACTIVE` = 1
							-- AND 
							`dept`.`SchlDeptHead_ID` = ". $_SESSION['USERID'] ." 
							AND `suboff`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ." 
							AND `suboff`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
							AND `suboff`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
					ORDER BY `crse`.`SchlAcadCrses_NAME`";
					
	//   ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
	//   echo var_dump($qry);
							
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} 
		// else if ($_GET['type'] == 'OFFERED_SUBJECT'){
		// 	$qry = "SELECT	`subj`.`SchlAcadSubj_CODE` `CODE`,
		// 				`subj`.`SchlAcadSubj_DESC` `DESC`,
		// 				`subj`.`SchlAcadSubj_UNIT` `UNIT`,
		// 				`crse`.`schlacadcrses_name` `COURSE`,
		// 				`sec`.`schlacadsec_name` `SECTION`,
		// 				`subjoff`.`SchlEnrollSubjOff_SCHEDULE_2` `SCHEDULE`,
		// 				'NONE' `GRADING_SCALE`,
		// 				(SELECT	COUNT(`ass`.`SchlEnrollAssSms_ID`) `COUNT`
		// 				FROM `schoolenrollmentassessment` `ass`
		// 					LEFT JOIN `schoolenrollmentadmission` `adm`
		// 						ON `ass`.`SchlEnrollAdm_ID` = `adm`.`SchlEnrollAdmSms_ID`
		// 					LEFT JOIN `schoolenrollmentregistration` `reg`
		// 						ON `adm`.`SchlEnrollReg_ID` = `reg`.`SchlEnrollRegSms_ID`
		// 				WHERE CONCAT(',',`ass`.`SchlAcadSubj_ID`,',') LIKE CONCAT('%,',`subjoff`.`SchlEnrollSubjOffSms_ID`,',%')
		// 					AND `ass`.`schlacadlvl_id` = `subjoff`.`schlacadlvl_id`
		// 					AND `ass`.`schlacadyr_id` = `subjoff`.`schlacadyr_id` 
		// 					AND `ass`.`SchlAcadPrd_ID`  = `subjoff`.`SchlAcadPrd_ID`
		// 					AND `ass`.`SchlAcadCrse_ID`  = `subjoff`.`SchlAcadCrses_ID`
		// 					AND `ass`.`SchlEnrollAss_STATUS` = 1
		// 					AND `adm`.`SchlEnrollAdm_STATUS` = 1
		// 					AND `reg`.`SchlEnrollReg_STATUS` = 1) `NO_OF_STUDENT`,
		// 				`subjoff`.`SchlEnrollSubjOffSms_ID` `OFFERED_SUBJ_SMS_ID`
		// 			FROM `schoolenrollmentsubjectoffered` `subjoff`
		// 				LEFT JOIN `schoolacademiccourses` `crse`
		// 					ON `subjoff`.`schlacadcrses_id` = `crse`.`schlacadcrsesms_id`
		// 				LEFT JOIN `schoolacademicsection` `sec`
		// 					ON `subjoff`.`SchlAcadSec_ID` = `sec`.`SchlAcadSecSms_ID`
		// 				LEFT JOIN `schoolacademicsubject` `subj`
		// 					ON `subjoff`.`SchlAcadSubj_ID` = `subj`.`SchlAcadSubjSms_ID`
		// 			WHERE  `subjoff`.`schlprof_id` = ". $_SESSION['USERID'] ."
		// 				AND `subjoff`.`schlacadlvl_id` = " .$_GET['levelid'] . "  
		// 				AND `subjoff`.`schlacadyr_id` = " .$_GET['yearid'] . "  
		// 				AND `subjoff`.`SchlAcadPrd_ID`  = " .$_GET['periodid'] . "
		// 				AND `subjoff`.`SchlAcadCrses_ID`  = " .$_GET['courseid'] . "
		// 				AND `subjoff`.`SchlEnrollSubjOff_STATUS` = 1
		// 				AND `subjoff`.`SchlEnrollSubjOff_ISACTIVE` = 1
		// 			ORDER BY `crse`.`schlacadcrses_name`";
		// 	$rsreg = $dbConn->query($qry);
		// 	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		// } 
		else if ($_GET['type'] == 'OFFERED_SUBJECT'){
			$qry = "SELECT DISTINCT `gscale`.`SchlAcadGradScale_CODE` `CODE`,
				`gscale`.`SchlAcadGradScale_NAME` `NAME`, 
				`gscale`.`SchlAcadGradScale_ID` `GS_ID`,
				`gscale`.`SchlAcadGradScale_DESC` `DESC`, 
				`gscale`.`SchlAcadGradScale_PASS_SCORE` `PASS_SCORE`, 
				`year`.`SchlAcadYr_NAME` `ACADYR`, 
				`level`.`SchlAcadLvl_NAME` `ACADLVL`,
				`period`.`SchlAcadPrd_NAME` `ACADPRD`,
				`crse`.`SchlAcadCrses_NAME` `ACADCRSE`
	
			FROM `schooldepartment` `dept`

			LEFT JOIN `schoolacademicgradingscale` `gscale`
			ON `dept`.`SchlDeptSms_ID` = `gscale`.`SchlDept_ID`
			LEFT JOIN `schoolacademiclevel` `level`
			ON `gscale`.`SchlAcadLvl_ID` = `level`.`SchlAcadLvlSms_ID`
			LEFT JOIN `schoolacademicyear` `year`
			ON `gscale`.`SchlAcadYr_ID` = `year`.`SchlAcadYrSms_ID`
			LEFT JOIN `schoolacademicperiod` `period`
			ON `gscale`.`SchlAcadPrd_ID` = `period`.`SchlAcadPrdSms_ID`
			LEFT JOIN `schoolacademiccourses` `crse`
			ON `gscale`.`SchlAcadCrse_ID` = `crse`.`SchlAcadCrseSms_ID`

			WHERE `dept`.`SchlDeptHead_ID` = ". $_SESSION['USERID'] ."
				AND `gscale`.`SchlAcadCrse_ID` = ". $_GET['courseid'] ." 
				AND `gscale`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ." 
				AND `gscale`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
				AND `gscale`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
				AND `gscale`.`SchlAcadGradScale_STATUS` = 1
				AND `gscale`.`SchlAcadGradScale_ISACTIVE` = 1
			ORDER BY `crse`.`schlacadcrses_name`";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'STUDENT_LIST'){
			$qry = "SELECT `sub`.`SchlAcadSubj_CODE` `CODE`, 
						`suboff`.`SchlEnrollSubjOffSms_ID` ID,
						`sub`.`SchlAcadSubj_DESC` `DESC`, 
						`suboff`.`SchlEnrollSubjOff_UNIT` `UNIT`, 
						IFNULL(`sec`.`SchlAcadSec_NAME`, '') `SEC`, 
						IFNULL(`suboff`.`SchlEnrollSubjOff_SCHEDULE_2`, '') `SCHED`, 
						IFNULL(`suboff`.`SchlProf_ID`, '') `PROF`,

						(SELECT COUNT(*) FROM `schoolenrollmentassessment` `ass` 
							WHERE CONCAT(',', `ass`.`SchlAcadSubj_ID`, ',') LIKE CONCAT('%,', `suboff`.`SchlEnrollSubjOffSms_ID`, ',%') 
							AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
							AND `ass`.`SchlAcadYr_ID` = ".$_GET['yearid']."
							AND `ass`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
							AND `ass`.`SchlEnrollAss_STATUS` = 1) `STUDENT_COUNT`,
						CASE CONCAT_WS('',`emp`.`SchlEmp_LNAME`, ', ', `emp`.`SchlEmp_FNAME`, ' ', `emp`.`SchlEmp_MNAME`)  -- only returns the ',' in concat
							WHEN ',' THEN '' -- if else for the return
							ELSE 
								CONCAT_WS('',`emp`.`SchlEmp_LNAME`, ', ', `emp`.`SchlEmp_FNAME`, ' ', `emp`.`SchlEmp_MNAME`)
							END `NAME`
			FROM `schoolenrollmentsubjectoffered` `suboff`

			LEFT JOIN `schoolacademicsubject` `sub`
			ON `suboff`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
			LEFT JOIN `schoolacademicsection` `sec`
			ON `suboff`.`SchlAcadSec_ID` = `sec`.`SchlAcadSecSms_ID`
			LEFT JOIN `schoolemployee` `emp`
			ON `suboff`.`SchlProf_ID` = `emp`.`SchlEmpSms_ID`

			WHERE `suboff`.`SchlAcadCrses_ID` = ". $_GET['courseid'] ." 
				AND `suboff`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ." 
				AND `suboff`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
				AND `suboff`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
				AND `suboff`.`SchlEnrollSubjOff_STATUS` = 1
				AND `suboff`.`SchlEnrollSubjOff_ISACTIVE` = 1

				HAVING `STUDENT_COUNT` > 0
				ORDER BY `CODE`
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'TAGGED_SUBJ'){
			$qry = "SELECT `suboff`.`SchlEnrollSubjOffSms_ID` `SUBOFF_ID`

					FROM `schoolacademicgradingscale` `gscale`

					LEFT JOIN `schoolacademicgradingscalesubject` `gscalesub`
					ON `gscale`.`SchlAcadGradScale_ID` = `gscalesub`.`SchlAcadGradScale_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `suboff`
					ON `gscalesub`.`SchlEnrollSubjOff_ID` = `suboff`.`SchlEnrollSubjOffSms_ID`

					WHERE `gscale`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ."
						AND `gscale`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
						AND `gscale`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
						AND `gscale`.`SchlAcadCrse_ID` = ". $_GET['courseid'] ."
						AND `gscale`.`SchlAcadGradScale_ID` = ". $_GET['gscaleid'] ."
						AND `suboff`.`SchlEnrollSubjOff_STATUS` = 1
						AND `suboff`.`SchlEnrollSubjOff_ISACTIVE` = 1
						AND `gscale`.`SchlAcadGradScale_STATUS` = 1
						AND `gscale`.`SchlAcadGradScale_ISACTIVE` = 1
						";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'ENCODED_SUBJ'){
			$qry = "SELECT `suboff`.`SchlEnrollSubjOffSms_ID` `SUBOFF_ID`, 
					(SELECT COUNT(`record`.`SchlStudAcadRec_ID`)

						FROM `schoolstudentacademicrecord` `record`

						LEFT JOIN `schoolacademicgradingscalesubject` `gscalesubject`
						ON `record`.`SchlAcadGradScale_ID` = `gscalesubject`.`SchlAcadGradScale_ID`
						AND `record`.`SchlEnrollSubjOff_ID` = `gscalesubject`.`SchlEnrollSubjOff_ID`

						WHERE `record`.`SchlEnrollSubjOff_ID` = `suboff`.`SchlEnrollSubjOffSms_ID`
					) `COUNT`

					FROM `schoolacademicgradingscale` `gscale`

					LEFT JOIN `schoolacademicgradingscalesubject` `gscalesub`
					ON `gscale`.`SchlAcadGradScale_ID` = `gscalesub`.`SchlAcadGradScale_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `suboff`
					ON `gscalesub`.`SchlEnrollSubjOff_ID` = `suboff`.`SchlEnrollSubjOffSms_ID`

					WHERE `gscale`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ."
						AND `gscale`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
						AND `gscale`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
						AND `gscale`.`SchlAcadCrse_ID` = ". $_GET['courseid'] ."
						AND `suboff`.`SchlEnrollSubjOff_STATUS` = 1
						AND `suboff`.`SchlEnrollSubjOff_ISACTIVE` = 1
						AND `gscale`.`SchlAcadGradScale_STATUS` = 1
						AND `gscale`.`SchlAcadGradScale_ISACTIVE` = 1
						";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'GSCALE_DISPLAY'){
			$qry = "SELECT `gscale`.`SchlAcadGradScale_ID` `ID`, 
						`gscale`.`SchlAcadGradScale_CODE` `CODE`, 
						`gscale`.`SchlAcadGradScale_NAME` `NAME`,
						`gscale`.`SchlAcadGradScale_DESC` `DESC`,
						`gscale`.`SchlAcadGradScale_PASS_SCORE` `PASS_SCORE`,
						`gscaledet`.`SchlAcadGradScaleDet_NAME` `COMP_NAME`, 
						`gscaledet`.`SchlAcadGradScaleDet_ID` `COMP_ID`,
						`gscaledet`.`SchlAcadGradScaleDet_CODE` `COMP_CODE`,
						`gscaledet`.`SchlAcadGradScaleDet_DESC` `COMP_DESC`,
						`gscaledet`.`SchlAcadGradScaleDet_PERCENTAGE` `COMP_PERCENT`,
						`gscaledet`.`SchlAcadGradScaleDet_PARENT_ID` `PARENT_ID`,
						`gscaledet`.`SchlAcadGradScaleDet_RANKNO` `RANK_NO`

					FROM `schoolacademicgradingscale` `gscale`

					LEFT JOIN `schoolacademicgradingscaledetail` `gscaledet`
					ON `gscale`.`SchlAcadGradScale_ID` = `gscaledet`.`SchlAcadGradScale_ID`

					WHERE `gscale`.`SchlAcadLvl_ID` = ". $_GET['levelid'] ."
						AND `gscale`.`SchlAcadYr_ID` = ". $_GET['yearid'] ."
						AND `gscale`.`SchlAcadPrd_ID` = ". $_GET['periodid'] ."
						AND `gscale`.`SchlAcadCrse_ID` = ". $_GET['courseid'] ."
						AND `gscale`.`SchlAcadGradScale_ID` = ". $_GET['gscaleid'] ."
						";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		}
		
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	}
	//else 
	//{
	//	echo '0';
	//}
?>

