<?php
	session_start();
	include_once '../../configuration/connection-config.php';
    // echo '<script>alert("Data Upload to DB Successful!!")</script>';

	if(isset($_GET['type'])){

		if ($_GET['type'] == 'STUDENT_LIST'){
			
			$qry = "SELECT DISTINCT `stud`.`SchlStudSms_ID` `STUD_ID`,
						`stud`.`SchlStud_NO` `STUD_NO`,
						TRIM(CONCAT(`info`.`SchlEnrollRegStudInfo_LAST_NAME`, ', ',
						`info`.`SchlEnrollRegStudInfo_FIRST_NAME`, ' ',
						`info`.`SchlEnrollRegStudInfo_MIDDLE_NAME`, ' ',
						`info`.`SchlEnrollRegStudInfo_SUFFIX_NAME`)) `FULL_NAME`

					FROM `schoolstudent` `stud`

					LEFT JOIN `schoolenrollmentregistration` `reg`
					ON `stud`.`SchlEnrollRegColl_ID` = `reg`.`SchlEnrollRegSms_ID`
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
					LEFT JOIN `schoolenrollmentregistrationstudentinformation` `info`
					ON `reg`.`SchlEnrollRegSms_ID` = `info`.`SchlEnrollReg_ID`

					WHERE `stud`.`SchlStud_STATUS` = 1
					AND `stud`.`SchlStud_ISACTIVE` = 1
					AND `reg`.`SchlEnrollReg_STATUS` = 1
					AND `ass`.`SchlEnrollAss_STATUS` = 1
					AND `info`.`SchlEnrollRegStudInfo_".$_GET['name_type']."` LIKE '%".$_GET['name_text']."%'
					ORDER BY `FULL_NAME`
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADLEVEL'){
			$qry = "SELECT DISTINCT `ass`.`SchlAcadLvl_ID` `ID`,
					`level`.`SchlAcadLvl_NAME` `NAME`
						
					FROM `schoolstudent` `stud`
						
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
					LEFT JOIN `schoolacademiclevel` `level`
					ON `ass`.`SchlAcadLvl_ID` = `level`.`SchlAcadLvlSms_ID`
					
					WHERE `stud`.`SchlStudSms_ID` = ".$_GET['stud_id']."
					AND `ass`.`SchlEnrollAss_STATUS` = 1
					ORDER BY `ID` DESC
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADYEAR'){
			$qry = "SELECT DISTINCT `ass`.`SchlAcadyr_ID` `ID`,
					`yr`.`SchlAcadyr_NAME` `NAME`
						
					FROM `schoolstudent` `stud`
						
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
					LEFT JOIN `schoolacademicyear` `yr`
					ON `ass`.`SchlAcadyr_ID` = `yr`.`SchlAcadyrSms_ID`
					
					WHERE `stud`.`SchlStudSms_ID` = ".$_GET['stud_id']."
						AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
					ORDER BY `ID` DESC
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADPERIOD'){
			$qry = "SELECT DISTINCT `ass`.`SchlAcadPrd_ID` `ID`,
						`prd`.`SchlAcadPrd_NAME` `NAME`
						
					FROM `schoolstudent` `stud`
					
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
					LEFT JOIN `schoolacademicperiod` `prd`
					ON `ass`.`SchlAcadPrd_ID` = `prd`.`SchlAcadPrdSms_ID`
					
					WHERE `stud`.`SchlStudSms_ID` = ".$_GET['stud_id']."
						AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
						AND `ass`.`SchlAcadYr_ID` = ".$_GET['yearid']."
					ORDER BY `ID` DESC
			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'ACADCOURSE'){
			$qry = "SELECT DISTINCT `ass`.`SchlAcadCrse_ID` `ID`,
						`crse`.`SchlAcadCrses_NAME` `NAME`
						
					FROM `schoolstudent` `stud`
					
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
					LEFT JOIN `schoolacademiccourses` `crse`
					ON `ass`.`SchlAcadCrse_ID` = `crse`.`SchlAcadCrseSms_ID`
					
					WHERE `stud`.`SchlStudSms_ID` = ".$_GET['stud_id']."
						AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
						AND `ass`.`SchlAcadYr_ID` = ".$_GET['yearid']."
						AND `ass`.`SchlAcadPrd_ID` = ".$_GET['periodid']."

			";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			
		} else if ($_GET['type'] == 'SUBJ_ID'){
			$qry = "SELECT TRIM(BOTH ',' FROM `ass`.`SchlAcadSubj_ID`) `ID`,
						`ass`.`SchlAcadLvl_ID` `LVL_ID`,
						`ass`.`SchlEnrollAssSms_ID` `ASS_ID`,
						`ass`.`SchlStud_ID` `STUD_ID`,
						'".$_SESSION['USERINFO']."' `REQUESTER`
				
					FROM `schoolstudent` `stud`
					
					LEFT JOIN `schoolenrollmentassessment` `ass`
					ON `stud`.`SchlStudSms_ID` = `ass`.`SchlStud_ID`
	
					WHERE `ass`.`SchlStud_ID` = ".$_GET['studid']."
						AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
						AND `ass`.`SchlAcadyr_ID` = ".$_GET['yearid']."
						AND `ass`.`SchlAcadprd_ID` = ".$_GET['periodid']."
						AND `ass`.`SchlAcadcrse_ID` = ".$_GET['courseid']."
						AND `ass`.`SchlEnrollAss_STATUS` = 1";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SUBJ_INFO'){
			$qry = "SELECT `suboff`.`SchlAcadLvl_ID` `LVL_ID`,
						`suboff`.`SchlEnrollSubjOffSms_ID` `ID`,
						`sub`.`SchlAcadSubj_CODE` `CODE`,
						`sub`.`SchlAcadSubj_DESC` `DESC`,
						`sub`.`SchlAcadSubj_UNIT` `UNIT`,
						`suboff`.`SchlProf_ID` `PROF_ID`,
						`emp`.`SchlEmp_FNAME` `FNAME`,
						`emp`.`SchlEmp_LNAME` `LNAME`,
						`emp`.`SchlEmp_MNAME` `MNAME`,
						IFNULL(`suboff`.`SchlEnrollSubjOff_SCHEDULE_2`, '') `SCHED`
					
					FROM `schoolenrollmentsubjectoffered` `suboff`
					
					LEFT JOIN `schoolacademicsubject` `sub`
					ON `suboff`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
					LEFT JOIN `schoolemployee` `emp`
					ON `suboff`.`SchlProf_ID` = `emp`.`SchlEmpSms_ID`
					
					WHERE `suboff`.`SchlEnrollSubjOffSms_ID` IN (".$_GET['subjectid'].")
						";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SUBJ_GRADE'){
			$qry = "SELECT `rec`.`SchlEnrollSubjOff_ID` `SUBJ_ID`,
						`recdet`.`SchlStudAcadRecDet_RECORDS` `FINAL_GRADE`,
						`recdet`.`SchlStudAcadRecDet_RESULT_TYPE` `REMARKS`,
						`rec`.`SchlStudAcadRec_REQ_STATUS` `STATUS`
						
					FROM `schoolenrollmentsubjectoffered` `suboff`
					
					LEFT JOIN `schoolacademicsubject` `sub`
					ON `suboff`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
					LEFT JOIN `schoolstudentacademicrecord` `rec`
					ON `suboff`.`SchlEnrollSubjOffSms_ID` = `rec`.`SchlEnrollSubjOff_ID`
					LEFT JOIN `schoolstudentacademicrecorddetail` `recdet`
					ON `rec`.`SchlStudAcadRec_ID` = `recdet`.`SchlStudAcadRec_ID`
					
					WHERE `suboff`.`SchlEnrollSubjOffSms_ID` IN (".$_GET['subjectid'].")
						AND `recdet`.`SchlEnrollAssSms_ID` = ".$_GET['assid']."
						AND `recdet`.`SchlStud_ID` = ".$_GET['studid']."
						-- AND (`rec`.`SchlStudAcadRec_REQ_STATUS` = 5
						-- OR `rec`.`SchlStudAcadRec_REQ_STATUS` = 8)
						";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'SUBJ_PERCENT'){
			$qry = "CALL spGETSTUDENTGRADES(".$_GET['studid'].",'".$_GET['comp_grade']."',".$_GET['levelid'].",".$_GET['yearid'].",".$_GET['periodid'].",".$_GET['courseid'].")";
			$rsreg = $dbConn->query($qry);	
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		} else if ($_GET['type'] == 'PRINT_INFO'){
			$qry = "SELECT DISTINCT `stud`.`SchlStud_IDNO` `IDNO`,
						CONCAT(`info`.`SchlEnrollRegStudInfo_LAST_NAME`, ', ',
							`info`.`SchlEnrollRegStudInfo_FIRST_NAME`, ' ',
							`info`.`SchlEnrollRegStudInfo_MIDDLE_NAME`, ' ',
							`info`.`SchlEnrollRegStudInfo_SUFFIX_NAME`) `NAME`,
						`yrlvl`.`SchlAcadYrLvl_NAME` `YRLVL`,
						`crse`.`SchlAcadCrses_NAME` `COURSE`
					
					FROM `schoolenrollmentassessment` `ass`
					
					LEFT JOIN `schoolenrollmentadmission` `adm`
					ON `ass`.`SchlEnrollAdm_ID` = `adm`.`SchlEnrollAdmSms_ID`
					LEFT JOIN `schoolenrollmentregistrationstudentinformation` `info`
					ON `adm`.`SchlEnrollReg_ID` = `info`.`SchlEnrollReg_ID`
					LEFT JOIN `schoolacademiccourses` `crse`
					ON `ass`.`SchlAcadCrse_ID` = `crse`.`SchlAcadCrseSms_ID`
					LEFT JOIN `schoolacademicyearlevel` `yrlvl`
					ON `ass`.`SchlAcadYrLvl_ID` = `yrlvl`.`SchlAcadYrLvlSms_ID`
					LEFT JOIN `schoolstudent` `stud`
					ON `ass`.`SchlStud_ID` = `stud`.`SchlStudSms_ID`
					
					WHERE `ass`.`SchlStud_ID` = ".$_GET['studid']."
					AND `ass`.`SchlAcadLvl_ID` = ".$_GET['levelid']."
					AND `ass`.`SchlAcadYr_ID` = ".$_GET['yearid']."
					AND `ass`.`SchlAcadPrd_ID` = ".$_GET['periodid']."
					AND `ass`.`SchlAcadCrse_ID` = ".$_GET['courseid']."
					AND `ass`.`SchlEnrollAss_STATUS` = 1
			";
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