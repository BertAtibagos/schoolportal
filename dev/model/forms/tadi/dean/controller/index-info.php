<?php
    // ✅ Secure cookie flags (must be set before session_start)
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_samesite', 'Strict');

    // PHP error handling
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

    session_start();
    include('../../../../configuration/connection-config.php');
$type = $_POST['type'];

if ($type == 'GET_ACADEMIC_LEVEL') {

	$qry = "SELECT `SchlAcadLvl_ID`,`SchlAcadLvl_NAME`, `SchlAcadLvl_DESC`
			FROM `schoolacademiclevel`
			WHERE `SchlAcadLvl_ISACTIVE` = 1";

	$rreg = $dbConn->query($qry);
	$fetch = $rreg->fetch_ALL(MYSQLI_ASSOC);
	$dbConn->close();
}

if ($type == 'GET_ACADEMIC_YEAR_LEVEL') {

	$lvlid = $_POST['lvl_id'];

	$qry = "SELECT 
				`SchlAcadYrLvlSms_ID` `ACAD_YRLVL_ID`,
				`SchlAcadYrLvl_NAME` `ACAD_YRLVL_NAME`
			FROM  
				`schoolacademicyearlevel`
			WHERE `SchlAcadYrLvl_STATUS` = 1 
			AND `SchlAcadYrLvl_ISACTIVE` = 1 
			AND `SchlAcadLvl_ID` = ?
			ORDER BY `SchlAcadYrLvl_RANKNO`";
    
	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("i",$lvlid);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_ACADEMIC_PERIOD') {

	$lvlid = $_POST['lvl_id'];

	$qry = " SELECT DISTINCT 
				`schl_acad_prd`.`SchlAcadPrdSms_ID` `acad_prd_id`,
				`schl_acad_prd`.`SchlAcadPrd_NAME` `acad_prd_name`
			FROM 	`schoolacademicyearperiod` `schl_acad_yr_prd`
			LEFT JOIN `schoolacademicperiod` `schl_acad_prd`
				ON `schl_acad_yr_prd`.`SchlAcadPrd_ID` =  `schl_acad_prd`.`SchlAcadPrdSms_ID`
			WHERE `schl_acad_yr_prd`.`SchlAcadLvl_ID` = ? 
			AND	`schl_acad_yr_prd`.`SchlAcadYrPrd_ISACTIVE` = 1";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("i",$lvlid);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_ACAD_YEAR') {

	$qry = " SELECT DISTINCT 
				`schl_acad_yr_prd`.`SchlAcadLvl_ID` `YEAR_ID`,
				`schl_yr`.`SchlAcadYr_DESC` `YEAR_NAME`, `SchlAcadYrSms_ID`
			FROM `schoolacademicyearperiod` `schl_acad_yr_prd`					
			LEFT JOIN `schoolacademicyear` `schl_yr`  
				ON `schl_acad_yr_prd`.`SchlAcadYr_ID` = `schl_yr`.`SchlAcadYrSms_ID`
			WHERE 
				`schl_acad_yr_prd`.`SchlAcadYrPrd_ISACTIVE` = 1 
			AND
				`schl_acad_yr_prd`.`SchlAcadLvl_ID` = 2 
			ORDER BY YEAR_NAME DESC";

	$rreg = $dbConn->query($qry);
	$fetch = $rreg->fetch_ALL(MYSQLI_ASSOC);
	$dbConn->close();
}

if ($type == 'GET_DEPARTMENTAL_SUBJECT') {

	$user = $_SESSION['USERID'];
	$lvlid = $_POST['lvl_id'];
	$prdid = $_POST['prd_id'];
	$yrid = $_POST['yr_id'];
	$yrlvlid = $_POST['yrlvl_id'];

	$qry = "SELECT  DISTINCT 				
				`schl_acad_subj`.`SchlAcadSubj_desc` AS `subj_desc`,
				`schl_acad_subj`.`SchlAcadSubj_CODE` AS `subj_code`,
				`schl_acad_subj`.`SchlAcadSubj_ID` AS `subj_id`,
				`schl_enr_subj_off`.`SchlAcadLvl_ID` AS `lvlid`,
				`schl_enr_subj_off`.`SchlAcadYr_ID` AS `yrid`,
				`schl_enr_subj_off`.`SchlAcadPrd_ID` AS `prdid`,
				`schl_enr_subj_off`.`SchlAcadYrLvl_ID` AS `yrlvlid`
			FROM `schoolenrollmentsubjectoffered` AS `schl_enr_subj_off`

			LEFT JOIN `schoolacademicsubject` `schl_acad_subj`
			ON `schl_enr_subj_off`.`SchlAcadSubj_ID` = `schl_acad_subj`.`SchlAcadSubjSms_ID`

			LEFT JOIN `schoolacademiccourses` `schl_acad_crses`
			ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID`

			LEFT JOIN `schooldepartment` `schl_dept`
			ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID`

			LEFT JOIN`schoolacademicsection` AS `schl_acad_sec`
			ON `schl_enr_subj_off`.`SchlAcadSec_ID` = `schl_acad_sec`.`SchlAcadSecSms_ID`

			LEFT JOIN schoolemployee AS emp
			ON `schl_enr_subj_off`. `SchlProf_ID`= emp.`SchlEmpSms_ID`
			WHERE

			`schl_enr_subj_off`.`SchlAcadLvl_ID` = ?  
			AND `schl_enr_subj_off`.`SchlAcadYr_ID`  = ?
			AND  `schl_enr_subj_off`.`SchlAcadPrd_ID` = ?  
			AND `schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?
			AND 
				(	SELECT `SchlDept_ID` 
					FROM `schoolemployee` 
					WHERE `SchlEmpSms_ID` = ?
				) = `schl_dept`.`SchlDeptSms_ID`
			AND schl_acad_subj.`SchlAcadSubj_DESC` IS NOT NULL
			AND `schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("iiiii", $lvlid, $yrid, $prdid, $yrlvlid, $user);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_INSTRUCTOR_LIST') {

	$user = $_SESSION['USERID'];
	$lvlid = $_POST['lvl_id'];
	$prdid = $_POST['prd_id'];
	$yrid = $_POST['yr_id'];
	$yrlvlid = $_POST['yrlvl_id'];

	$qry = "SELECT DISTINCT 
				`schl_enr_subj_off`.`SchlProf_ID`,
				CONCAT(
					emp.SchlEmp_LNAME,
					', ',
					emp.SchlEmp_FNAME,
					' ',
					emp.SchlEmp_MNAME
				) AS prof_name 

			FROM `schoolenrollmentsubjectoffered` `schl_enr_subj_off` 

			LEFT JOIN `schoolacademiccourses` `schl_acad_crses` 
				ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID` 
			LEFT JOIN `schooldepartment` `schl_dept` 
				ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID` 
			LEFT JOIN schoolemployee AS emp 
				ON `schl_enr_subj_off`.`SchlProf_ID` = emp.`SchlEmpSms_ID` 
			WHERE `schl_enr_subj_off`.`SchlAcadLvl_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYr_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadPrd_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?
			AND (SELECT 
				`SchlDept_ID` 
			FROM
				`schoolemployee` 
			WHERE `SchlEmpSms_ID` = ?) = `schl_dept`.`SchlDeptSms_ID`
				AND `schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1 
				AND emp.`SchlEmp_ID` IS NOT NULL 
			ORDER BY prof_name ASC ";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("iiiii", $lvlid, $yrid, $prdid, $yrlvlid, $user);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}
 
if ($type == 'GET_SECTION_LIST') {

	$profId = $_POST['prof_id'];
	$lvlid = $_POST['lvlid'];
	$prdid = $_POST['prdid'];
	$yrid = $_POST['yrid'];
	$yrlvlid = $_POST['yrlvlid'];

    $qry = "SELECT DISTINCT
				`schl_enr_subj_off`.`SchlProf_ID` AS `prof_id`,
				`schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` AS `subj_act`,
				`schl_acad_sec`.`SchlAcadSec_NAME` AS `section_name`, 
					`schl_acad_subj`.`SchlAcadSubj_desc` AS `subj_desc`,
				`schl_enr_subj_off`.`SchlEnrollSubjOffSms_ID` AS `subj_id`
			FROM `schoolenrollmentsubjectoffered` AS `schl_enr_subj_off`

			LEFT JOIN `schoolacademicsubject` AS `schl_acad_subj` 
				ON `schl_enr_subj_off`.`SchlAcadSubj_ID` = `schl_acad_subj`.`SchlAcadSubjSms_ID`
			LEFT JOIN `schoolacademicsection` AS `schl_acad_sec` 
				ON `schl_enr_subj_off`.`SchlAcadSec_ID` = `schl_acad_sec`.`SchlAcadSecSms_ID`
			LEFT JOIN `schoolacademiccourses` AS `schl_acad_crses` 
				ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID`
			LEFT JOIN `schooldepartment` AS `schl_dept` 
				ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID`
			LEFT JOIN `schoolacademicyearperiod` AS `schl_acad_yr_prd` 
				ON `schl_enr_subj_off`.`SchlAcadYr_ID` = `schl_acad_yr_prd`.`SchlAcadYr_ID`
			LEFT JOIN `schoolacademicyear` AS `schl_yr` 
				ON `schl_acad_yr_prd`.`SchlAcadYr_ID` = `schl_yr`.`SchlAcadYrSms_ID`

			WHERE `schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` = 1 
			AND `schl_enr_subj_off`.`SchlProf_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadLvl_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadPrd_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYr_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("iiiii",$profId ,$lvlid, $prdid, $yrid, $yrlvlid);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if($type == 'GETALL_TADI_RECORDS'){

	$profId = $_POST['prof_id'];
	$subj_off_id = $_POST['subj_off_id'];

	$qry = "SELECT 
				CONCAT(`SchlEnrollRegStudInfo_LAST_NAME`, ', ', `SchlEnrollRegStudInfo_FIRST_NAME`,' ',`SchlEnrollRegStudInfo_MIDDLE_NAME`) AS stud_name,
				schl_tadi.`schltadi_id` AS schltadi_ID,
				schl_tadi.`schltadi_date` AS tadi_date,
				CONCAT(schl_tadi.`schltadi_mode`, ' ', schl_tadi.`schltadi_type`) AS tadi_modeType,
				schl_tadi.`schltadi_timein` AS tadi_timeIn,
				schl_tadi.`schltadi_timeout` AS tadi_timeOut,
				schl_tadi.`schltadi_activity` AS tadi_act,
				schl_tadi.`schltadi_status` AS tadi_status,
				schl_tadi.`schltadi_filepath` AS tadi_filepath,
				schl_tadi.schlenrollsubjoff_id AS sub_off_id,
				schl_tadi.SchlProf_ID 
			FROM `schooltadi` AS schl_tadi 
			
			LEFT JOIN `schoolstudent` AS schl_stud 
				ON schl_tadi.`schlstud_id` = schl_stud.`SchlStudSms_ID` 

			LEFT JOIN `schoolenrollmentregistration` AS schl_enr_reg 
				ON schl_stud.`SchlEnrollRegColl_ID` = schl_enr_reg.`SchlEnrollRegSms_ID` 

			LEFT JOIN `schoolenrollmentregistrationstudentinformation` AS schl_reg_stud 
				ON schl_enr_reg.`SchlEnrollRegSms_ID` = `schl_reg_stud`.`SchlEnrollReg_ID` 

			WHERE `schlprof_id` =  ?
			AND `schlenrollsubjoff_id` =  ?
			ORDER BY schl_tadi.`schltadi_date` DESC, schl_tadi.`schltadi_timein` DESC";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("ii",$profId ,$subj_off_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_INSTRUCTOR_BY_SUBJECT') {
	
	$subj_id = $_POST['subj_id'];
	$lvlid = $_POST['lvlid'];
	$prdid = $_POST['prdid'];
	$yrid = $_POST['yrid'];
	$yrlvlid = $_POST['yrlvlid'];

	$qry = "SELECT DISTINCT 
				`schl_enr_subj_off`.`SchlProf_ID`,
				`schl_acad_subj`.`SchlAcadSubj_CODE` `subj_code`,
				`schl_acad_subj`.`SchlAcadSubj_ID` `subj_id`,					
				CONCAT(emp.SchlEmp_LNAME, ',', emp.SchlEmp_FNAME, ' ', emp.SchlEmp_MNAME) AS prof_name,
				`schl_enr_subj_off`.`SchlAcadLvl_ID` AS lvlid,
				`schl_enr_subj_off`.`SchlAcadPrd_ID` AS prdid,
				`schl_enr_subj_off`.`SchlAcadYr_ID` AS yrid,
				`schl_enr_subj_off`.`SchlAcadYrLvl_ID` AS yrlvlid
			FROM `schoolenrollmentsubjectoffered` `schl_enr_subj_off`
			
			LEFT JOIN `schoolacademicsubject` `schl_acad_subj`
				ON `schl_enr_subj_off`.`SchlAcadSubj_ID` = `schl_acad_subj`.`SchlAcadSubjSms_ID`

			LEFT JOIN `schoolacademiccourses` `schl_acad_crses`
				ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID`

			LEFT JOIN `schooldepartment` `schl_dept`
				ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID`

			LEFT JOIN schoolemployee AS emp
				ON `schl_enr_subj_off`. `SchlProf_ID`= emp.`SchlEmpSms_ID`

			WHERE `schl_acad_subj`.`SchlAcadSubj_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadLvl_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadPrd_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYr_ID`  = ?
			AND `schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("iiiii",$subj_id, $lvlid, $prdid, $yrid, $yrlvlid);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_SUBJECT_BY_INSTRUCTOR') {

	$profId = $_POST['prof_id'];
	$lvlid = $_POST['lvl_id'];
	$prdid = $_POST['prd_id'];
	$yrid = $_POST['yr_id'];
	$yrlvlid = $_POST['yrlvl_id'];

	$qry = "SELECT DISTINCT
				CONCAT(emp.SchlEmp_LNAME, ',', emp.SchlEmp_FNAME, ' ', emp.SchlEmp_MNAME) AS prof_name,
				schl_enr_subj_off.`SchlEnrollSubjOffSms_ID` AS sub_off_id,
				`schl_acad_sec`.`SchlAcadSec_NAME` AS schl_sec,
				`schl_acad_subj`.`SchlAcadSubj_CODE` AS `subj_code`,
				`schl_acad_subj`.`SchlAcadSubj_desc` AS `subj_desc`,
				`schl_acad_subj`.`SchlAcadSubj_NAME` AS `subj_name`,
				`schl_enr_subj_off`.`SchlProf_ID`,
				`schl_enr_subj_off`.`SchlAcadLvl_ID` AS lvlid,
				`schl_enr_subj_off`.`SchlAcadYr_ID`AS yrid,
				`schl_enr_subj_off`.`SchlAcadPrd_ID` AS prdid,
				`schl_enr_subj_off`.`SchlAcadYrLvl_ID` AS yrlvlid,
				`schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` AS `subj_act`
			FROM`schoolenrollmentsubjectoffered` AS `schl_enr_subj_off`

			LEFT JOIN `schoolacademicsubject` AS `schl_acad_subj`
				 ON `schl_enr_subj_off`.`SchlAcadSubj_ID` = `schl_acad_subj`.`SchlAcadSubjSms_ID`
			LEFT JOIN `schoolacademicsection` AS `schl_acad_sec` 
				ON `schl_enr_subj_off`.`SchlAcadSec_ID` = `schl_acad_sec`.`SchlAcadSecSms_ID`
			LEFT JOIN `schoolacademiccourses` AS `schl_acad_crses`
				ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID`
			LEFT JOIN `schooldepartment` AS `schl_dept` 
				ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID`
			LEFT JOIN `schoolacademicyearperiod` AS `schl_acad_yr_prd` 
				ON `schl_enr_subj_off`.`SchlAcadYr_ID` = `schl_acad_yr_prd`.`SchlAcadYr_ID`
			LEFT JOIN `schoolacademicyear` AS `schl_yr` 
				ON `schl_acad_yr_prd`.`SchlAcadYr_ID` = `schl_yr`.`SchlAcadYrSms_ID`
			LEFT JOIN schoolemployee AS emp 
				ON `schl_enr_subj_off`.`SchlProf_ID` = emp.`SchlEmpSms_ID` 
			
			WHERE `schl_enr_subj_off`.`SchlProf_ID` = ?
			AND`schl_enr_subj_off`.`SchlAcadLvl_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYr_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadPrd_ID` = ?
			AND `schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?";

	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("iiiii",$profId, $lvlid, $yrid, $prdid, $yrlvlid);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	$dbConn->close();
}

if($type == 'SEARCH_SUBJECT_BY_INSTRUCTOR'){

	$lvlid = $_POST['lvlid'];
	$prdid = $_POST['prdid'];
	$yrid = $_POST['yrid'];
	$yrlvlid = $_POST['yrlvlid'];
	$prof_id = $_POST['prof_id'];
	$subjDesc = $_POST['subjDesc'];
	$subjCode = $_POST['subjCode'];
	$section = $_POST['section'];

	$qry = "SELECT DISTINCT 
				CONCAT(emp.SchlEmp_LNAME,',',emp.SchlEmp_FNAME,' ',emp.SchlEmp_MNAME) AS prof_name,
				schl_enr_subj_off.`SchlEnrollSubjOffSms_ID` AS sub_off_id,
				`schl_acad_sec`.`SchlAcadSec_NAME` AS schl_sec,
				`schl_acad_subj`.`SchlAcadSubj_CODE` AS `subj_code`,
				`schl_acad_subj`.`SchlAcadSubj_desc` AS `subj_desc`,
				`schl_acad_subj`.`SchlAcadSubj_NAME` AS `subj_name`,
				`schl_enr_subj_off`.`SchlProf_ID`,
				`schl_enr_subj_off`.`SchlAcadLvl_ID` AS lvlid,
				`schl_enr_subj_off`.`SchlAcadYr_ID` AS yrid,
				`schl_enr_subj_off`.`SchlAcadPrd_ID` AS prdid,
				`schl_enr_subj_off`.`SchlAcadYrLvl_ID` AS yrlvlid,
				`schl_enr_subj_off`.`SchlEnrollSubjOff_ISACTIVE` AS `subj_act` 
			FROM `schoolenrollmentsubjectoffered` AS `schl_enr_subj_off`

			LEFT JOIN `schoolacademicsubject` AS `schl_acad_subj` 
				ON `schl_enr_subj_off`.`SchlAcadSubj_ID` = `schl_acad_subj`.`SchlAcadSubjSms_ID` 
			LEFT JOIN `schoolacademicsection` AS `schl_acad_sec` 
				ON `schl_enr_subj_off`.`SchlAcadSec_ID` = `schl_acad_sec`.`SchlAcadSecSms_ID` 
			LEFT JOIN `schoolacademiccourses` AS `schl_acad_crses` 
				ON `schl_enr_subj_off`.`SchlAcadCrses_ID` = `schl_acad_crses`.`SchlAcadCrseSms_ID` 
			LEFT JOIN `schooldepartment` AS `schl_dept` 
				ON `schl_acad_crses`.`SchlDept_ID` = `schl_dept`.`SchlDeptSms_ID` 
			LEFT JOIN `schoolacademicyearperiod` AS `schl_acad_yr_prd` 
				ON `schl_enr_subj_off`.`SchlAcadYr_ID` = `schl_acad_yr_prd`.`SchlAcadYr_ID` 
			LEFT JOIN `schoolacademicyear` AS `schl_yr` 
				ON `schl_acad_yr_prd`.`SchlAcadYr_ID` = `schl_yr`.`SchlAcadYrSms_ID` 
			LEFT JOIN schoolemployee AS emp 
				ON `schl_enr_subj_off`.`SchlProf_ID` = emp.`SchlEmpSms_ID` 
				
			WHERE `schl_enr_subj_off`.`SchlProf_ID` = ? 
			AND 
				`schl_enr_subj_off`.`SchlAcadLvl_ID` = ?
			AND
				`schl_enr_subj_off`.`SchlAcadYr_ID` = ? 
			AND
				`schl_enr_subj_off`.`SchlAcadPrd_ID` = ?
			AND
				`schl_enr_subj_off`.`SchlAcadYrLvl_ID` = ?
			AND `schl_acad_subj`.`SchlAcadSubj_CODE` LIKE ?
			AND `schl_acad_subj`.`SchlAcadSubj_desc` LIKE ?
			AND `schl_acad_sec`.`SchlAcadSec_NAME` LIKE ?";

	$stmt = $dbConn->prepare($qry);
	

	if ($stmt) {
        
        $srchSubCode = "%" . $subjCode . "%";
		$srchSubDesc = "%" . $subjDesc . "%";
		$srchSection = "%" . $section . "%";

        $stmt->bind_param("iiiiisss",$prof_id, $lvlid, $yrid, $prdid, $yrlvlid, $srchSubCode, $srchSubDesc, $srchSection);
		$stmt->execute();
		$result = $stmt->get_result();
		$fetch = $result->fetch_all(MYSQLI_ASSOC);
		$stmt->close();
		$dbConn->close();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to prepare SQL statement."]);
    }
}

if($type == 'GET_IMAGE'){

	$prof_id = $_POST['prof_id'];
	$REC_ID = $_POST['tadi_id'];

	$qry = "SELECT 
				`schltadi_filepath` AS `tadi_filepath`,
				`tadi_exifDate` AS exif_date,
				`tadi_exifTime` AS exif_time,
				`schltadi_date` AS upld_date,
				`schltadi_timein` AS upld_time
			FROM `schooltadi`
			WHERE `schlprof_id` = ?
			AND `schltadi_id` = ?";
	
	$stmt = $dbConn->prepare($qry);
	$stmt->bind_param("ii", $prof_id, $REC_ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_assoc();
	$stmt->close();
	$dbConn->close();
}

if ($type == 'GET_TADI_RECORDS') {

    $profId = $_POST['prof_id'];
    $strtDateSearch = $_POST['strtDateSearch'] ?? null;
    $endDateSearch = $_POST['endDateSearch'] ?? null;
    $subj_off_id = $_POST['subj_off_id'];
    $tadiStatus = $_POST['tadiStatus'] ?? null;

    $qry = "SELECT 
                CONCAT(`SchlEnrollRegStudInfo_LAST_NAME`, ', ', `SchlEnrollRegStudInfo_FIRST_NAME`, ' ', `SchlEnrollRegStudInfo_MIDDLE_NAME`) AS stud_name,
                schl_tadi.`schltadi_id` AS schltadi_ID,
                schl_tadi.`schltadi_date` AS tadi_date,
                CONCAT(schl_tadi.`schltadi_mode`, ' ', schl_tadi.`schltadi_type`) AS tadi_modeType,
                schl_tadi.`schltadi_timein` AS tadi_timeIn,
                schl_tadi.`schltadi_timeout` AS tadi_timeOut,
                schl_tadi.`schltadi_activity` AS tadi_act,
                schl_tadi.`schltadi_status` AS tadi_status,
                schl_tadi.`schltadi_filepath` AS tadi_filepath,
                schl_tadi.schlenrollsubjoff_id AS sub_off_id,
                schl_tadi.SchlProf_ID,
                section.`SchlAcadSec_NAME`
            FROM `schooltadi` AS schl_tadi

            LEFT JOIN `schoolstudent` AS schl_stud 
                ON schl_tadi.`schlstud_id` = schl_stud.`SchlStudSms_ID`
            LEFT JOIN `schoolenrollmentregistration` AS schl_enr_reg 
                ON schl_stud.`SchlEnrollRegColl_ID` = schl_enr_reg.`SchlEnrollRegSms_ID`
            LEFT JOIN `schoolenrollmentregistrationstudentinformation` AS schl_reg_stud 
                ON schl_enr_reg.`SchlEnrollRegSms_ID` = schl_reg_stud.`SchlEnrollReg_ID`
            LEFT JOIN `schoolenrollmentsubjectoffered` AS schl_subjoff
                ON schl_tadi.`schlenrollsubjoff_id` = schl_subjoff.`SchlEnrollSubjOffSms_ID`
            LEFT JOIN `schoolacademicsection` AS section
                ON schl_subjoff.`SchlAcadSec_ID` = section.`SchlAcadSecSms_ID`
            WHERE schl_tadi.`SchlProf_ID` = ?
              AND schl_tadi.`schlenrollsubjoff_id` = ?";

    $params = [];
    $types  = "ii"; 

    if (!empty($tadiStatus)) {
        $qry .= " AND schl_tadi.`schltadi_status` = ?";
        $types  .= "i";
        $params[] = $tadiStatus;
    }

    if (!empty($strtDateSearch) && !empty($endDateSearch)) {
        $qry .= " AND schl_tadi.`schltadi_date` BETWEEN ? AND ?";
        $types  .= "ss";
        $params[] = $strtDateSearch;
        $params[] = $endDateSearch;
    }

    $qry .= " ORDER BY schl_tadi.`schltadi_date` DESC";

    $stmt = $dbConn->prepare($qry);

    if (!$stmt) {
        die("Prepare failed: " . $dbConn->error);
    }

    $bindValues = array_merge([$types, $profId, $subj_off_id], $params);
    $stmt->bind_param(...$bindValues);

    $stmt->execute();
    $result = $stmt->get_result();

    $fetch = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $dbConn->close();
}

echo json_encode($fetch); 