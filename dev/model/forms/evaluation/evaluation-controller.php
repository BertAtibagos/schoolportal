<?php
  session_start();
  include_once '../../configuration/connection-config.php';
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  if(isset($_GET['mode']))
  {
	  if ($_GET['mode'] === 'SEARCH_EVALUATION_INFORMATION')
	  {
			$SchlAcadLvl_ID =  $_SESSION['LVLID'];
			$SchlAcadYr_ID = $_SESSION['YRID'];
			$SchlAcadPrd_ID = $_SESSION['PRDID'];
			$SchlAcadYrLvl_ID = $_SESSION['YRLVLID'];
			$SchlAcadCrses_ID = $_SESSION['CRSEID'];
			$SchlAcadSec_ID = $_SESSION['SECID'];
			$SchlStud_ID = intval($_SESSION['USERID']);
		// $qry = "SELECT * FROM (SELECT IFNULL(`eval`.`SchlEvalInfo_CODE`,'') `EVAL_INFO_CODE`,
					// IFNULL(`eval`.`SchlEvalInfo_NAME`,'') `EVAL_INFO_NAME`,
					// IFNULL(`eval`.`SchlEvalInfo_DESC`,'') `EVAL_INFO_DESC`,
					// IFNULL(DATE_FORMAT(`eval`.`SchlEvalInfo_DATE_FROM`,'%Y-%m-%d'),DATE_FORMAT(NOW(),'%Y-%m-%d')) `START_DATE`,
					// IFNULL(DATE_FORMAT(`eval`.`SchlEvalInfo_DATE_TO`,'%Y-%m-%d'),DATE_FORMAT(NOW(),'%Y-%m-%d')) `END_DATE`,
					// IFNULL(DATE_FORMAT(`eval`.`SchlEvalInfo_DATE_FROM`,'%Y-%m-%d'),DATE_FORMAT(NOW(),'%h:%i:%s')) `START_TIME`,
					// IFNULL(DATE_FORMAT(`eval`.`SchlEvalInfo_DATE_TO`,'%Y-%m-%d'),DATE_FORMAT(NOW(),'%h:%i:%s')) `END_TIME`,
					// IFNULL(`quest`.`SchlEvalQuest_DESC`,'') `QUEST_DESC`,
					// IFNULL((CASE UPPER(TRIM(IFNULL(`eval`.`SchlEvalInfo_TBL_NAME`,'')))
						// WHEN 'SCHOOLEVALUATION' THEN 
							// (SELECT GROUP_CONCAT(
								// CONCAT(IFNULL(`emp`.`SchlEmpSms_ID`,0),
									// '=',
									// REPLACE(IFNULL(`subj`.`SchlAcadSubj_NAME`,''),',','[||]'),
									// '=',
									// CASE TRIM(CONCAT(IFNULL(`emp`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`emp`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`emp`.`SchlEmp_MNAME`,''), ' ' ,IFNULL(`emp`.`SchlEmp_SUFFIX`,'')))
										// WHEN '[||]' THEN 'NONE'
										// ELSE 
											// TRIM(CONCAT(IFNULL(`emp`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`emp`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`emp`.`SchlEmp_MNAME`,''), ' ' ,IFNULL(`emp`.`SchlEmp_SUFFIX`,'')))
									// END,
									// '=',
									// IFNULL(`offered`.`SchlEnrollSubjOffSms_ID`,0)))
								  // FROM `schoolenrollmentsubjectoffered` `offered`
								// LEFT JOIN `schoolacademicsubject` `subj`
									// ON `offered`.`SchlAcadSubj_ID` = `subj`.`SchlAcadSubjSms_ID`
								// LEFT JOIN `schoolemployee` `emp`
									// ON FIND_IN_SET(`offered`.`SchlProf_ID`,`emp`.`SchlEmpSms_ID`)
								// WHERE FIND_IN_SET(`offered`.`SchlEnrollSubjOffSms_ID`,
									// (SELECT IFNULL(`ass`.`SchlAcadSubj_ID`,'')
										 // FROM `SchoolStudent` `stud` 
										// LEFT JOIN `schoolenrollmentregistration` `reg`
											// ON `stud`.`SchlEnrollRegColl_ID` = `reg`.`SchlEnrollRegSms_ID`
										// LEFT JOIN `schoolenrollmentadmission` `adm`
											// ON `reg`.`SchlEnrollRegSms_ID` = `adm`.`SchlEnrollReg_ID`
										// LEFT JOIN `schoolenrollmentassessment` `ass`
											// ON `adm`.`SchlEnrollAdmSms_ID` = `ass`.`SchlEnrollAdm_ID`
									   // WHERE `stud`.`SchlStudSms_ID` = ".$SchlStud_ID .")))
						// ELSE
							// ''
					// END),'') `CATEGORY`,
					// (SELECT GROUP_CONCAT(CONCAT(REPLACE(IFNULL(`SchlEval_DESC`,''),',','[||]'),
									// '=',
									// IFNULL(`SchlEval_ID`,0)))
						// FROM `schoolevaluation` WHERE FIND_IN_SET(`SchlEval_ID`,`eval`.`SchlEvalInfo_TBL_ID`))
					// `EVALUATION`,
					// IFNULL(GROUP_CONCAT(IFNULL(`quest`.`SchlEvalInfo_TBL_ID`,0),
									   // '=',
									   // IFNULL(`quest`.`SchlEvalQuest_ID`,0),
									// '=',
									// REPLACE(IFNULL(`quest`.`SchlEvalQuest_DESC`,''),',','[||]'))
					// ,'') `QUESTIONAIRE`,
					// IFNULL((SELECT GROUP_CONCAT(
						// CONCAT(IFNULL(`SchlEvalQuestChoiceAns_ID`,0),
							   // '=',
							   // REPLACE(IFNULL(`SchlEvalQuestChoiceAns_DESC`,''),',','[||]'),
							   // '=',
							   // REPLACE(IFNULL(`SchlEvalQuestChoiceAns_REMARKS`,''),',','[||]')))
						 // FROM `schoolevaluationquestionairechoiceanswer`
					   // WHERE FIND_IN_SET(
							// `SchlEvalQuestChoiceAns_ID`,
							// `quest`.`SchlEvalQuestChoiceAns_ID`
								 // )
					  // ORDER BY `SchlEvalQuestChoiceAns_RANKNO`
					// ),'') `QUEST_CHOICE_ANS`,
					// IFNULL(`anstype`.`SchlEvalAnsType_CODE`,'') `ANS_TYPE_CODE`,
					// IFNULL(`quest`.`SchlEvalQuest_RANKNO`,0) `QUEST_RANKNO`,
					// IFNULL(`eval`.`SchlEvalInfo_RANKNO`,0) `EVAL_INFO_RANKNO`,
					// IFNULL(`quest`.`SchlEvalQuest_IS_REQUIRED`,0) `QUEST_IS_REQUIRED`,
					// IFNULL(`anstype`.`SchlEvalAnsType_ID`,0) `ANS_TYPE_ID`,
					// IFNULL(`eval`.`SchlEvalInfo_ID`,0) `EVAL_INFO_ID`,
					// IFNULL(`quest`.`SchlEvalQuest_ID`,0) `QUEST_ID`
					 // FROM `schoolevaluationinformation` `eval`
					// LEFT JOIN `schoolevaluationquestionaire` `quest`
						// ON find_in_set(`quest`.`SchlEvalInfo_TBL_ID`,`eval`.`SchlEvalInfo_TBL_ID`)
					// LEFT JOIN `schoolevaluationanswertype` `anstype`
						// ON `quest`.`SchlEvalAnsType_ID` = `anstype`.`SchlEvalAnsType_ID`
					// WHERE `eval`.`SchlAcadLvl_ID` = ".SchlAcadLvl_ID."
						// AND `eval`.`SchlAcadYr_ID` = ".SchlAcadYr_ID."
						// AND `eval`.`SchlAcadPrd_ID` = ".SchlAcadPrd_ID."
						// AND `eval`.`SchlAcadYrLvl_ID` = ".SchlAcadYrLvl_ID."
						// AND `eval`.`SchlAcadCrse_ID` = ".SchlAcadCrse_ID."
						// AND `eval`.`SchlAcadSec_ID` =  0
						// AND `eval`.`SchlEvalInfo_ISACTIVE` = 1
						// AND `eval`.`SchlEvalInfo_STATUS` = 1
					// ORDER BY `eval`.`SchlEvalInfo_RANKNO` DESC) `EVAL`";
			
			//echo $_SESSION['LVLID'];
			$qry = "CALL spGETEvaluationInformation(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlAcadYrLvl_ID.",".$SchlAcadCrses_ID.",".$SchlAcadSec_ID.",".$SchlStud_ID.")";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			$rsreg->free_result();
			$dbConn->close();
			echo json_encode($fetch);
	  } 
	  else if ($_GET['mode'] == 'SEARCH_EVALUATION_DETAILS')
	  {
			$SchlAcadLvl_ID =  $_SESSION['LVLID'];
			$SchlAcadYr_ID = $_SESSION['YRID'];
			$SchlAcadPrd_ID = $_SESSION['PRDID'];
			$SchlAcadYrLvl_ID = $_SESSION['YRLVLID'];
			$SchlAcadCrses_ID = $_SESSION['CRSEID'];
			$SchlAcadSec_ID = $_SESSION['SECID'];
			$SchlStud_ID = intval($_SESSION['USERID']);
			
			$qry = "SELECT REPLACE(IFNULL(`sub`.`SchlAcadSubj_CODE`,''),',','[||]') `SUBJ_CODE`,
									REPLACE(IFNULL(`sub`.`SchlAcadSubj_DESC`,''),',','[||]') `SUBJ_DESC`,
									IFNULL(`em`.`SchlEmpSms_ID`,0) `TBL_ID`,
									IFNULL(
										CASE TRIM(CONCAT(IFNULL(`em`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`em`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`em`.`SchlEmp_MNAME`,'')))
											WHEN '[||]' THEN 'NONE'
											ELSE 
												TRIM(CONCAT(IFNULL(`em`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`em`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`em`.`SchlEmp_MNAME`,'')))
										END,'NONE') `EMP_NAME`,
									IFNULL(`off`.`SchlEnrollSubjOffSms_ID`,0) `TBL_UNIQUE_ID`,
									REPLACE(IFNULL(`evinfo`.`SchlEvalInfo_NAME`,''),',','[||]') `EVAL_INFO_NAME`,
									IFNULL(`evinfo`.`SchlEvalInfo_ID`,'') `EVAL_INFO_ID`,
									IFNULL((SELECT DISTINCT `SchlEvalAns_ANSWER`
											FROM `schoolevaluationanswer` 
										WHERE `SchlStud_ID` = `st`.`SchlStudSms_ID`
											AND `SchlEvalInfo_ID` = `evinfo`.SchlEvalInfo_ID
											AND `SchlEvalInfo_TBL_ID` = `em`.`SchlEmpSms_ID`
											AND `SchlEvalInfo_TBL_UNIQUE_ID` = `off`.`SchlEnrollSubjOffSms_ID` ORDER BY `SchlEvalvAns_ID` DESC LIMIT 0,1),'') `ANSWER`
								FROM `schoolstudent` `st`
									LEFT JOIN `schoolenrollmentassessment` `as`
										ON `st`.`SchlStudSms_ID` = `as`.`SchlStud_ID`
									LEFT JOIN `schoolenrollmentsubjectoffered` `off`
										ON FIND_IN_SET(`off`.`SchlEnrollSubjOffSms_ID`,`as`.`SchlAcadSubj_ID`)
									LEFT JOIN `schoolacademicsubject` `sub`
										ON `off`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
									LEFT JOIN `schoolemployee` `em`
										ON `off`.`SchlProf_ID` = `em`.`SchlEmpSms_ID`
									LEFT JOIN `schoolevaluationinformation` `evinfo`
										ON `evinfo`.`SchlAcadLvl_ID` = `as`.`SchlAcadLvl_ID`
							WHERE `as`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
								AND `as`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
								AND `as`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
								AND `st`.`SchlStudSms_ID`=".$SchlStud_ID;
			//$qry = "CALL spGETEvaluationDetails(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlAcadYrLvl_ID.",".$SchlAcadCrses_ID.",".$SchlAcadSec_ID.",".$SchlStud_ID.")";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			$rsreg->free_result();
			$dbConn->close();
			echo json_encode($fetch);
		} 
		else if ($_GET['mode'] == 'SEARCH_EVALUATION_QUESTIONAIRE')
	   { 
			$SchlAcadLvl_ID =  $_SESSION['LVLID'];
			$SchlAcadYr_ID = $_SESSION['YRID'];
			$SchlAcadPrd_ID = $_SESSION['PRDID'];
			$SchlEvalInfo_ID = intval($_GET['schlevalinfo_id']);
			
			$qry = "SELECT DISTINCT 
						`QUESTIONAIREID`,
						`QUESTIONAIRE`,
						`QUEST_RANKNO`,
						`EVAL_DESC`,
						`EVAL_INFO_RANKNO`,
						`EVAL_INFO_ID`,
						`QUEST_IS_REQUIRED`,
						`QUEST_ID`,
						`CHOICES`,
						`CATEGORY`,
						`CATEGORY_ID`,
						`ANSTYPE_DESC`,
						`ANSTYPE_ID`,
						IFNULL(`ans`.`SchlEvalQuestChoiceAns_DESC`,'') `CHOICES_DESC`,
						IFNULL(`ans`.`SchlEvalQuestChoiceAns_RANKNO`,0) `CHOICES_RANKNO`,
						IFNULL(`ans`.`SchlEvalQuestChoiceAns_REMARKS`,'') `CHOICES_REMARKS`,
						IFNULL(`ans`.`SchlEvalQuestChoiceAns_ID`,0) `CHOICES_ID` FROM 
									(SELECT IFNULL(`quest`.`SchlEvalQuest_ID`,0) `QUESTIONAIREID`,
										IFNULL(`quest`.`SchlEvalQuest_DESC`,'') `QUESTIONAIRE`,
										IFNULL(`quest`.`SchlEvalQuest_RANKNO`,0) `QUEST_RANKNO`,
										IFNULL(`info`.`SchlEval_DESC`,'') `EVAL_DESC`,
										IFNULL(`eval`.`SchlEvalInfo_RANKNO`,0) `EVAL_INFO_RANKNO`,
										IFNULL(`eval`.`SchlEvalInfo_ID`,0) `EVAL_INFO_ID`,
										IFNULL(`quest`.`SchlEvalQuest_IS_REQUIRED`,0) `QUEST_IS_REQUIRED`,
										IFNULL(`quest`.`SchlEvalQuest_ID`,0) `QUEST_ID`,
										IFNULL(`quest`.`SchlEvalQuestChoiceAns_ID`,'') `CHOICES`,
										IFNULL(`info`.`SchlEval_DESC`,'') `CATEGORY`,
										IFNULL(`info`.`SchlEval_ID`,0) `CATEGORY_ID`,
										IFNULL(`anstype`.`SchlEvalAnsType_CODE`,'') `ANSTYPE_DESC`,
										IFNULL(`anstype`.`SchlEvalAnsType_ID`,0) `ANSTYPE_ID`
									FROM `schoolevaluationinformation` `eval`
										LEFT JOIN `schoolevaluationquestionaire` `quest`
											ON FIND_IN_SET(`quest`.`SchlEvalInfo_TBL_ID`,`eval`.`SchlEvalInfo_TBL_ID`)
										LEFT JOIN `schoolevaluationanswertype` `anstype`
											ON `quest`.`SchlEvalAnsType_ID` = `anstype`.`SchlEvalAnsType_ID`
										LEFT JOIN `schoolevaluation` `info`
											ON FIND_IN_SET(`info`.`SchlEval_ID`,`quest`.`SchlEvalInfo_TBL_ID`)
									WHERE `eval`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
										AND `eval`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
										AND `eval`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
										AND `eval`.`SchlEvalInfo_ID` = ".$SchlEvalInfo_ID.") `QUESTIONS`
									LEFT JOIN `schoolevaluationquestionairechoiceanswer` `ans`
											ON FIND_IN_SET(`ans`.`SchlEvalQuestChoiceAns_ID`,`QUESTIONS`.`CHOICES`)";
											
			//$qry = "CALL spGETEvaluationquestionaire(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlEvalInfo_ID.")";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			$rsreg->free_result();
			$dbConn->close();
			echo json_encode($fetch);
		} 
		else if ($_GET['mode'] == 'INSERT')
		{
			$mode = mysqli_real_escape_string($dbConn, $_GET['mode']);  
			$schlevalans_answer = mysqli_real_escape_string($dbConn, $_GET['schlevalans_answer']);  
			$schlevalinfo_id = intval($_GET['schlevalinfo_id']);
			$schlevalnfo_tbl_id = intval($_GET['schlevalinfo_tbl_id']);  
			$schlevalnfo_tbl_unique_id = intval($_GET['schlevalinfo_tbl_unique_id']);  
			$schlstud_id = intval($_SESSION['USERID']); 
			$schlevalans_comments = mysqli_real_escape_string($dbConn, $_GET['schlevalans_comments']);  
			//$status = 1;
			$qry = "CALL spMANAGESchoolEvaluationAnswer('".$mode."','".$schlevalans_answer."','".$schlevalans_comments."',".$schlevalinfo_id.",".$schlevalnfo_tbl_id.",".$schlevalnfo_tbl_unique_id.",".$schlstud_id.")";
			$rsreg = $dbConn->query($qry);
			$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
			$rsreg->free_result();
			$dbConn->close();
			echo json_encode($fetch);
		}
	}
?>