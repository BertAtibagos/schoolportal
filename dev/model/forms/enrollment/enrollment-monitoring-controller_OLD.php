<?php
	session_start();
	require_once '../../configuration/connection-config.php';
	//include '../../../configuration/connection-config.php';
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	if ($_GET['type'] == 'ACADLEVEL'){
		$qry = "SELECT DISTINCT `lvl`.`schlacadlvlsms_id` `ID`, 
					`lvl`.`schlacadlvl_name` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
					LEFT JOIN `schoolacademiclevel` `lvl`
						ON `subj_off`.`SchlAcadLvl_ID` = `lvl`.`SchlAcadLvlSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `dept`.`SchlDeptHead_ID`=". $_SESSION['USERID']." " . "
					ORDER BY `NAME`";
		$rsreg = $dbConn->query($qry);	
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'ACADYEAR'){
		$qry ="SELECT DISTINCT `yr`.`schlacadyrsms_id` `ID`, 
					`yr`.`schlacadyr_name` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
					LEFT JOIN `schoolacademicyear` `yr`
						ON `subj_off`.`SchlAcadYr_ID` = `yr`.`SchlAcadYrSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . " 
					AND `dept`.`SchlDeptHead_ID`=". $_SESSION['USERID']." " . "
					ORDER BY `yr`.`SchlAcadYr_RANKNO` DESC";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'ACADPERIOD'){
		$qry = "SELECT DISTINCT `prd`.`schlacadprdsms_id` `ID`, 
					`prd`.`schlacadprd_name` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
					LEFT JOIN `schoolacademicperiod` `prd`
						ON `subj_off`.`SchlAcadPrd_ID` = `prd`.`SchlAcadPrdSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . " 
					AND `subj_off`.`SchlAcadYr_ID` = " .$_GET['yearid'] . "
					AND `dept`.`SchlDeptHead_ID`= ". $_SESSION['USERID'] . " ". "
				ORDER BY `prd`.`SchlAcadPrd_RANKNO`,`NAME`";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'ACADCOURSE'){
		$qry = "SELECT DISTINCT `crse`.`SchlAcadCrseSms_ID` `ID`,
					`crse`.`SchlAcadCrses_NAME` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
					LEFT JOIN `schoolacademiccourses` `crse1`
						ON `subj_off`.`SchlAcadCrses_ID` = `crse1`.`SchlAcadCrseSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . "  " . "
					AND `subj_off`.`SchlAcadYr_ID` = " .$_GET['yearid'] . " " . "
					AND `dept`.`SchlDeptHead_ID`= ". $_SESSION['USERID'] . " " . "
					AND `subj_off`.`SchlAcadPrd_ID` = " .$_GET['periodid'] . " " . "
				ORDER BY `NAME`";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'ACADYEARLEVEL'){
		$qry = "SELECT DISTINCT `yrlvl`.`SchlAcadYrLvlSms_ID` `ID`, 
					`yrlvl`.`SchlAcadYrLvl_NAME` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
					LEFT JOIN `schoolacademicyearlevel` `yrlvl`
						ON `subj_off`.`SchlAcadYrLvl_ID` = `yrlvl`.`SchlAcadYrLvlSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . " " . "
					AND `subj_off`.`SchlAcadYr_ID` = " .$_GET['yearid'] . " " . "
					AND `dept`.`SchlDeptHead_ID`= ". $_SESSION['USERID'] . " " . "
					AND `subj_off`.`SchlAcadPrd_ID` = " .$_GET['periodid'];
				if (intval($_GET['courseid']) > 0){
					$qry = $qry . " AND `subj_off`.`SchlAcadCrses_ID` = " .intval($_GET['courseid']);
				}
				$qry = $qry. " ORDER BY `NAME`";
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'INSTRUCTOR'){
		$qry = "SELECT DISTINCT CASE ISNULL(`emp`.`SchlEmpSms_ID`)
									WHEN 1 THEN 
										0
									ELSE
										`emp`.`SchlEmpSms_ID` 
								END `ID`, 
						CONCAT(CASE ISNULL(`emp`.`SchlEmp_LNAME`)
									WHEN 1 THEN 
										''
									ELSE
										`emp`.`SchlEmp_LNAME`
								END,', ', 
								CASE ISNULL(`emp`.`SchlEmp_FNAME`)
									WHEN 1 THEN 
										''
									ELSE
										`emp`.`SchlEmp_FNAME`
								END, ' ' , 
								CASE ISNULL(`emp`.`SchlEmp_MNAME`)
									WHEN 1 THEN 
										''
									ELSE
										`emp`.`SchlEmp_MNAME`
								END) `NAME`
					FROM `schooldepartment` `dept`
						LEFT JOIN `schoolacademiccourses` `crse`
							ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
						LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
							ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID` 
						LEFT JOIN `schoolemployee` `emp`
							ON `subj_off`.`SchlProf_ID` = `emp`.`SchlEmpSms_ID`
					WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
						AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
						AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . " " . "
						AND `subj_off`.`SchlAcadYr_ID` = " .$_GET['yearid'] . " " . "
						AND `dept`.`SchlDeptHead_ID`= ". $_SESSION['USERID'] . " " . "
						AND `subj_off`.`SchlAcadPrd_ID` = " .$_GET['periodid'];
						if (intval($_GET['courseid']) > 0){
							$qry = $qry . " AND `subj_off`.`SchlAcadCrses_ID` = " .intval($_GET['courseid']);
						}
						if (intval($_GET['yearlevelid']) > 0){
							$qry = $qry . " AND `subj_off`.`SchlAcadYrLvl_ID` = " .intval($_GET['yearlevelid']);
						}
						$qry = $qry . " ORDER BY `NAME`";
				
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'ACADSUBJECT'){
		$qry = "SELECT DISTINCT `subj`.`SchlAcadSubjSms_ID` `ID`, 
					`subj`.`SchlAcadSubj_CODE` `NAME`
				FROM `schooldepartment` `dept`
					LEFT JOIN `schoolacademiccourses` `crse`
						ON `dept`.`SchlDeptSms_ID` = `crse`.`SchlDept_ID`
					LEFT JOIN `schoolenrollmentsubjectoffered` `subj_off`
						ON `crse`.`SchlAcadCrseSms_ID` = `subj_off`.`SchlAcadCrses_ID`
					LEFT JOIN `schoolacademicsubject` `subj`
						ON `subj_off`.`SchlAcadSubj_ID` = `subj`.`SchlAcadSubjSms_ID`
					LEFT JOIN `schoolacademicyearlevel` `yrlvl`
						ON `subj_off`.`SchlAcadYrLvl_ID` = `yrlvl`.`SchlAcadYrLvlSms_ID`
				WHERE `subj_off`.`SchlEnrollSubjOff_STATUS` = 1
					AND `subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1
					AND `subj_off`.`SchlAcadLvl_ID` = " .$_GET['levelid'] . " " . "
					AND `subj_off`.`SchlAcadYr_ID` = " .$_GET['yearid'] . " " . "
					AND `dept`.`SchlDeptHead_ID`= ". $_SESSION['USERID'] . " " . "
					AND `subj_off`.`SchlAcadPrd_ID` = " .$_GET['periodid'];
				if (intval($_GET['courseid']) > 0){
					$qry = $qry . " AND `subj_off`.`SchlAcadCrses_ID` = " . intval($_GET['courseid']);
				}
				if (intval($_GET['yearlevelid']) > 0){
					$qry = $qry . " AND `subj_off`.`SchlAcadYrLvl_ID` = " . intval($_GET['yearlevelid']);
				}
				if (intval($_GET['userid']) > 0){
					$qry = $qry . " AND `subj_off`.`SchlProf_ID` IN (" . intval($_GET['userid']) .")";
				}
				$qry = $qry. " ORDER BY `NAME`";
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} else if ($_GET['type'] == 'TOTAL_ENROLLED_STUDENT'){
		$SchlAcadLvl_ID = intval($_GET['levelid']);  
		$SchlAcadYr_ID = intval($_GET['yearid']);  
		$SchlAcadPrd_ID = intval($_GET['periodid']);
		$SchlAcadCrse_ID = intval($_GET['courseid']);
		$SchlAcadYrLvl_ID = intval($_GET['yearlevelid']);
		$SchlDeptHead_ID = intval($_GET['headid']);
		$SchlAcadSubj_ID = intval($_GET['offeredsubjid']);
		$Categorytype = intval($_GET['categorytype']);
				
		$qry = "CALL spGETenrollmentsummary(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlAcadCrse_ID.",".$SchlAcadYrLvl_ID.",".$SchlDeptHead_ID.",".$SchlAcadSubj_ID.",".$Categorytype.");";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	//} else if ($_GET['type'] == 'TOTAL_OFFERED_COURSE'){
	//	$SchlAcadLvl_ID = intval($_GET['levelid']);  
	//	$SchlAcadYr_ID = intval($_GET['yearid']);  
	//	$SchlAcadPrd_ID = intval($_GET['periodid']);
	//	$SchlAcadCrse_ID = intval($_GET['courseid']);
	//	$SchlAcadYrLvl_ID = intval($_GET['yearlevelid']);
	//	$SchlDeptHead_ID = intval($_GET['headid']);
	//	$SchlAcadSubj_ID = intval($_GET['offeredsubjid']);
				
	//	$qry = "CALL spGETenrollmentsummary(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlAcadCrse_ID.",".$SchlAcadYrLvl_ID.",".$SchlDeptHead_ID.",".$SchlAcadSubj_ID.");";
	//	$rsreg = $dbConn->query($qry);
	//	$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	} 
	
	$rsreg->free_result();
	$dbConn->close();
	echo json_encode($fetch);
?>