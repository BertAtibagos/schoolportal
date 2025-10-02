<?php
	session_start();
	include_once '../../configuration/connection-config.php';
    // echo '<script>alert("Data Upload to DB Successful!!")</script>';

	if(isset($_POST['type'])){

		if ($_SESSION['USERTYPE'] == 'STUDENT'){
			$usertype = 2;
			$qry = "SELECT DISTINCT 
						IFNULL(`stud`.`SchlStud_IDNO`, '') `IDNO`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_LRNNO`, '') `LRN`,

						CASE CONCAT_WS('',`info`.`SchlEnrollRegStudInfo_LAST_NAME`, ', ', `info`.`SchlEnrollRegStudInfo_FIRST_NAME`, ' ', `info`.`SchlEnrollRegStudInfo_MIDDLE_NAME`, ' ', `info`.`SchlEnrollRegStudInfo_SUFFIX_NAME`)
							WHEN ',' THEN '' -- if else for the return
							ELSE 
								CONCAT_WS('',`info`.`SchlEnrollRegStudInfo_LAST_NAME`, ', ', `info`.`SchlEnrollRegStudInfo_FIRST_NAME`, ' ', `info`.`SchlEnrollRegStudInfo_MIDDLE_NAME`, ' ', `info`.`SchlEnrollRegStudInfo_SUFFIX_NAME`)
							END `NAME`,
						IFNULL(`yrlvl`.`SchlAcadYrLvl_NAME`, '') `YRLVL`,
						IFNULL(`crse`.`SchlAcadCrses_NAME`, '') `COURSE`,
						IFNULL(`sec`.`SchlAcadSec_NAME`, '') `SEC`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_GENDER`, '') `GENDER`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_AGE`, '') `AGE`,
						IFNULL(DATE_FORMAT(`info`.`SchlEnrollRegStudInfo_BIRTH_DATE` , '%M %d, %Y'), '') `BDAY`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_BIRTH_PLACE`, '') `BPLACE`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_RELIGION`, '') `RELIGION`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_CIVILSTATUS`, '') `CIVIL_STAT`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_NATIONALITY`, '') `NATION`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_EMAIL_ADD`, '') `EMAIL`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_MOB_NO`, '') `MOBNO`,
						IFNULL(`info`.`SchlEnrollRegStudInfo_TEL_NO`, '') `TELNO`,
						IFNULL(`info`.`schlenrollregstudinfo_perm_add`, '') `PERM_ADD`,
						IFNULL(`info`.`schlenrollregstudinfo_perm_zipcode`, '') `PERM_ZIP`,
						IFNULL(`info`.`schlenrollregstudinfo_pres_add`, '') `PRES_ADD`,
						IFNULL(`info`.`schlenrollregstudinfo_pres_zipcode`, '') `PRES_ZIP`,
						IFNULL(`perm_brgy`.`philarealocbrgy_name`, '') `PERM_BRGY_NAME`,
						IFNULL(`perm_mun`.`philarealocmun_name`, '') `PERM_MUN_NAME`,
						IFNULL(`perm_prov`.`philarealocprov_name`, '') `PERM_PROV_NAME`,
						IFNULL(`pres_brgy`.`philarealocbrgy_name`, '') `PRES_BRGY_NAME`,
						IFNULL(`pres_mun`.`philarealocmun_name`, '') `PRES_MUN_NAME`,
						IFNULL(`pres_prov`.`philarealocprov_name`, '') `PRES_PROV_NAME`,
						CASE CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_FATHER_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_FATHER_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_FATHER_MIDDLE_NAME`)
							WHEN ',' THEN '' -- if else for the return
							ELSE 
								CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_FATHER_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_FATHER_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_FATHER_MIDDLE_NAME`)
							END `FATHER_NAME`,
						CASE CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_MOTHER_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_MOTHER_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_MOTHER_MIDDLE_NAME`)
							WHEN ',' THEN '' -- if else for the return
							ELSE 
								CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_MOTHER_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_MOTHER_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_MOTHER_MIDDLE_NAME`)
							END `MOTHER_NAME`,
						CASE CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_MIDDLE_NAME`)
							WHEN ',' THEN '' -- if else for the return
							ELSE 
								CONCAT_WS('',`fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_LAST_NAME`, ', ', `fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_FIRST_NAME`, ' ', `fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_MIDDLE_NAME`)
							END `GUARDIAN_NAME`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_FATHER_CONTACT_NO`, '') `FATHER_CONTACT`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_FATHER_EMAIL_ADD`, '') `FATHER_EMAIL`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_MOTHER_CONTACT_NO`, '') `MOTHER_CONTACT`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_MOTHER_EMAIL_ADD`, '') `MOTHER_EMAIL`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_CONTACT_NO`, '') `GUARDIAN_CONTACT`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_EMAIL_ADD`, '') `GUARDIAN_EMAIL`,
						IFNULL(`fam_info`.`SchlEnrollRegFamInfo_GUARDIAN_RELATIONSHIP`, '') `GUARDIAN_REL`
				
				FROM `systemuser` `user`
				
				LEFT JOIN `schoolstudent` `stud`
				ON `user`.`SchlUser_ID` = `stud`.`SchlStudSms_ID`
				
				LEFT JOIN `schoolenrollmentregistration` `reg`
				ON `stud`.`SchlEnrollRegColl_ID` = `reg`.`SchlEnrollRegSms_ID`
				LEFT JOIN `schoolenrollmentregistrationstudentinformation` `info`
				ON `reg`.`SchlEnrollRegSms_ID` = `info`.`SchlEnrollReg_ID`
				LEFT JOIN `schoolenrollmentadmission` `adm`
				ON `reg`.`SchlEnrollRegSms_ID` = `adm`.`SchlEnrollReg_ID`
				LEFT JOIN `schoolenrollmentassessment` `ass`
				ON `adm`.`SchlEnrollAdmSms_ID` = `ass`.`SchlEnrollAdm_ID`
				LEFT JOIN `schoolacademiccourses` `crse`
				ON `ass`.`SchlAcadCrse_ID` = `crse`.`SchlAcadCrseSms_ID`
				LEFT JOIN `schoolacademicyearlevel` `yrlvl`
				ON `ass`.`SchlAcadYrLvl_ID` = `yrlvl`.`SchlAcadYrLvlSms_ID`
				LEFT JOIN `schoolacademicsection` `sec`
				ON `ass`.`SchlAcadSec_ID` = `sec`.`SchlAcadSecSms_ID`
				
				LEFT JOIN `philippine_area_location_barangay` `perm_brgy`
				ON `info`.`schlenrollregstudinfo_perm_brgy_id` = `perm_brgy`.`philarealocbrgy_id`
				LEFT JOIN `philippine_area_location_barangay` `pres_brgy`
				ON `info`.`schlenrollregstudinfo_pres_brgy_id` = `pres_brgy`.`philarealocbrgy_id`
				
				LEFT JOIN `philippine_area_location_municipality` `perm_mun`
				ON `info`.`schlenrollregstudinfo_perm_mun_id` = `perm_mun`.`philarealocmun_id`
				LEFT JOIN `philippine_area_location_municipality` `pres_mun`
				ON `info`.`schlenrollregstudinfo_pres_mun_id` = `pres_mun`.`philarealocmun_id`
				
				LEFT JOIN `philippine_area_location_province` `perm_prov`
				ON `info`.`schlenrollregstudinfo_perm_prov_id` = `perm_prov`.`philarealocprov_id`
				LEFT JOIN `philippine_area_location_province` `pres_prov`
				ON `info`.`schlenrollregstudinfo_pres_prov_id` = `pres_prov`.`philarealocprov_id`
				
				LEFT JOIN `schoolenrollmentregistrationfamilyinformation` `fam_info`
				ON `reg`.`SchlEnrollRegSms_ID` = `fam_info`.`SchlEnrollReg_ID`
				
				WHERE `user`.`SchlUser_ID` = ".$_SESSION['USERID']."
				AND `user`.`SysUserType_ID` = ".$usertype." ";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_SESSION['USERTYPE'] == 'EMPLOYEE'){
			$qry ="SELECT DISTINCT 
						IFNULL(`emp`.`SchlEmpSms_ID` ,'') `EMP_ID`,
						IFNULL(`emp`.`SchlEmp_LNAME` ,'') `LNAME`,
						IFNULL(`emp`.`SchlEmp_FNAME` ,'') `FNAME`,
						IFNULL(`emp`.`SchlEmp_MNAME` ,'') `MNAME`,
						IFNULL(`dept`.`SchlDept_NAME` ,'') `DEPT_NAME`,
						IFNULL(`jobpos`.`SchlJobPos_NAME` ,'') `JOBPOS_NAME`,
						CONCAT(`emp`.`SchlEmp_LNAME`, ', ', `emp`.`SchlEmp_FNAME`, ' ', `emp`.`SchlEmp_MNAME`) `NAME`,
						
						IFNULL(`emp`.`SchlEmp_GENDER` ,'') `GENDER`,
						IFNULL(`emp`.`SchlEmp_AGE` ,'') `AGE`,
						IFNULL(DATE_FORMAT(`emp`.`SchlEmp_BDAY` , '%M %d, %Y') ,'') `BDAY`,
						IFNULL(`emp`.`SchlEmp_BIRTHPLACE` ,'') `BPLACE`,
						IFNULL(`emp`.`SchlEmp_CIVILSTATUS` ,'') `CIVIL_STAT`,
						IFNULL(`emp`.`SchlEmp_CITIZENSHIP` ,'') `CTZ`,
						IFNULL(`emp`.`SchlEmp_EMAILADDRESS` ,'') `EMAIL`,
						IFNULL(`emp`.`SchlEmp_MOBNO` ,'') `MOBNO`,
						IFNULL(`emp`.`SchlEmp_PRESENTADDRESS` ,'') `PRES_ADD`,
						IFNULL(`emp`.`SchlEmp_PERMANENTADDRESS` ,'') `PERM_ADD` 
				
				FROM `schoolemployee` `emp`
				
				LEFT JOIN `schooldepartment` `dept`
				ON `emp`.`SchlDept_ID` = `dept`.`SchlDeptSms_ID`
				LEFT JOIN `schooljobposition` `jobpos`
				ON `emp`.`SchlJobPos_ID` = `jobpos`.`SchlJobPosSms_ID`
				
				WHERE `emp`.`SchlEmpSms_ID` = ".$_SESSION['USERID']."
				AND `emp`.`SchlEmp_ISACTIVE` = 1
				AND `emp`.`SchlEmp_STATUS` = 1";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} 
		
	} else {
    	echo '<script>alert("POST NOT SET. CONTACT ICT DEPARTMENT")</script>';
	}

	$rsreg->free_result();
	$dbConn->close();
	echo json_encode($fetch);
?>