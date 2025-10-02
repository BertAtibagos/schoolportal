<?php
   if(session_status() === PHP_SESSION_NONE){
		session_start();
		// echo var_dump($_SESSION);
	}
  require_once '../../configuration/connection-config.php';
  
  if(isset($_GET['mode'])){
	  if ($_GET['mode'] == 'SEARCH_SURVEY'){
		
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlStud_ID = intval($_SESSION['USERID']);

		$qry = "SELECT `survey`.`SchlSurvInfo_ID` `SURVEY_INFO_ID`,
					`survey`.`SchlSurvInfo_DESC` `SURVEY_INFO_DESC`,
					`survey`.`SchlSurvInfo_RANKNO` `SURVEY_RANK`,
					`survey`.`SchlSurvInfo_TBL_NAME` `SURVEY_TBL_NAME`,
					`survey`.`SchlSurvInfo_COL_NAME` `SURVEY_COL_NAME`,
					`survey`.`SchlSurvInfo_COL_DESC` `SURVEY_COL_DESC`,
					`survey`.`SchlSurvInfo_TBL_ID` `SURVEY_TBL_ID`

				FROM `schoolsurveyinformation` `survey`

				LEFT JOIN `schoolenrollmentassessment` `ass`
				ON `survey`.`SchlAcadLvl_ID` = `ass`.`SchlAcadLvl_ID` AND `survey`.`SchlAcadYr_ID` = `ass`.`SchlAcadYr_ID` AND `survey`.`SchlAcadPrd_ID` = `ass`.`SchlAcadPrd_ID` 

				WHERE `survey`.`SchlSurvInfo_ISOPEN` = 1
					AND `survey`.`SchlSurvInfo_ISACTIVE` = 1
					AND `survey`.`SchlSurvInfo_STATUS` = 1
					AND `ass`.`SchlStud_ID` = ".$SchlStud_ID."
							
				ORDER BY `SURVEY_RANK` ASC;";

		// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
		// echo var_dump($qry);
				
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	   } else if($_GET['mode'] === 'SEARCH_EVALUATION'){
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlStud_ID = intval($_SESSION['USERID']);

		$qry = "SELECT `eval`.`SchlEvalInfo_ID` `EVAL_INFO_ID`,
					`eval`.`SchlEvalInfo_DESC` `EVAL_INFO_DESC`,
					`eval`.`SchlEvalInfo_RANKNO` `EVAL_RANK`,
					`eval`.`SchlEvalInfo_TBL_NAME` `EVAL_TBL_NAME`,
					`eval`.`SchlEvalInfo_COL_NAME` `EVAL_COL_NAME`,
					`eval`.`SchlEvalInfo_TBL_ID` `EVAL_TBL_ID`

				FROM `schoolevaluationinformation` `eval`

				LEFT JOIN `schoolenrollmentassessment` `ass`
				ON `eval`.`SchlAcadLvl_ID` = `ass`.`SchlAcadLvl_ID` AND `eval`.`SchlAcadYr_ID` = `ass`.`SchlAcadYr_ID` AND `eval`.`SchlAcadPrd_ID` = `ass`.`SchlAcadPrd_ID` 

				WHERE `eval`.`SchlEvalInfo_STATUS` = 1
				AND `eval`.`SchlEvalInfo_ISACTIVE` = 1
				AND `eval`.`SchlEvalInfo_ISOPEN` = 1 
				AND `ass`.`SchlStud_ID` = ".$SchlStud_ID."

				ORDER BY `EVAL_RANK` ASC;";

				// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
				// echo var_dump($qry);

		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	   } else if($_GET['mode'] === 'SEARCH_PER_SURVEY'){
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlStud_ID = intval($_SESSION['USERID']);

		$tbl_name = $_GET['survey_tbl_name'];
		$col_name = $_GET['survey_col_name'];
		$col_desc = $_GET['survey_col_desc'];
		$info_id = $_GET['survey_info_id'];
		
		$qry = "SELECT `tbl`.`".$col_name."` `ID`,
						`tbl`.`".$col_desc."` `DESC`,
						`survey`.`SchlSurvInfo_ID` `SURVEY_INFO_ID`,
						IFNULL((SELECT GROUP_CONCAT(
								CONCAT(`SchlSurvInfo_ID`,':',`tbl`.`".$col_name."`,'[||]',`SchlSurvAns_ANSWER`)) 
								   FROM `schoolsurveyanswer`
							 WHERE `SchlStud_ID` = ".$SchlStud_ID."
								AND `SchlSurvInfo_ID` = `survey`.`SchlSurvInfo_ID`
								AND `SchlSurvInfo_TBL_ID` = `tbl`.`".$col_name."`),'') `ANSWER`
				FROM `".$tbl_name."` `tbl`
					LEFT JOIN `schoolsurveyinformation` `survey`
						ON FIND_IN_SET(`tbl`.`".$col_name."`,
							(SELECT `SchlSurvInfo_TBL_ID` FROM `schoolsurveyinformation` 
								WHERE `SchlAcadLvl_ID` = `survey`.`SchlAcadLvl_ID` 
									AND `SchlSurvInfo_ID` = `survey`.`SchlSurvInfo_ID`
									AND `SchlAcadYr_ID` = `survey`.`SchlAcadYr_ID`  
									AND `SchlAcadPrd_ID` = `survey`.`SchlAcadPrd_ID` 
									AND `SchlSurvInfo_ISOPEN` = 1))
				WHERE `survey`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID." 
					-- AND `survey`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID." 
					-- AND `survey`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID." 
					AND `SchlSurvInfo_ID` = ".$info_id."
					AND `survey`.`SchlSurvInfo_ISOPEN` = 1
                    
            ORDER BY `DESC` ASC;";

		// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
		// echo var_dump($qry);
		
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	} else if($_GET['mode'] === 'SEARCH_PER_EVALUATION'){
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlStud_ID = intval($_SESSION['USERID']);
		$SchlEvalInfo_ID = intval($_GET['infoid']);
		
		// $qry = "SELECT REPLACE(IFNULL(`sub`.`SchlAcadSubj_CODE`,''),',','[||]') `SUBJ_CODE`,
		// 						REPLACE(IFNULL(`sub`.`SchlAcadSubj_DESC`,''),',','[||]') `SUBJ_DESC`,
		// 						IFNULL(`em`.`SchlEmpSms_ID`,0) `TBL_ID`,
		// 						IFNULL(
		// 							CASE TRIM(CONCAT(IFNULL(`em`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`em`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`em`.`SchlEmp_MNAME`,'')))
		// 								WHEN '[||]' THEN 'NONE'
		// 								ELSE 
		// 									TRIM(CONCAT(IFNULL(`em`.`SchlEmp_LNAME`,''),'[||]',IFNULL(`em`.`SchlEmp_FNAME`,''), ' ' , IFNULL(`em`.`SchlEmp_MNAME`,'')))
		// 							END,'NONE') `EMP_NAME`,
		// 						IFNULL(`off`.`SchlEnrollSubjOffSms_ID`,0) `TBL_UNIQUE_ID`,
		// 						REPLACE(IFNULL(`evinfo`.`SchlEvalInfo_NAME`,''),',','[||]') `EVAL_INFO_NAME`,
		// 						IFNULL(`evinfo`.`SchlEvalInfo_ID`,'') `EVAL_INFO_ID`,
		// 						IFNULL((SELECT DISTINCT `SchlEvalAns_ANSWER`
		// 								FROM `schoolevaluationanswer` 
		// 							WHERE `SchlStud_ID` = `st`.`SchlStudSms_ID`
		// 								AND `SchlEvalInfo_ID` = `evinfo`.SchlEvalInfo_ID
		// 								AND `SchlEvalInfo_TBL_ID` = `em`.`SchlEmpSms_ID`
		// 								AND `SchlEvalInfo_TBL_UNIQUE_ID` = `off`.`SchlEnrollSubjOffSms_ID` ORDER BY `SchlEvalvAns_ID` DESC LIMIT 0,1),'') `ANSWER`
		// 					FROM `schoolstudent` `st`
		// 						LEFT JOIN `schoolenrollmentassessment` `as`
		// 							ON `st`.`SchlStudSms_ID` = `as`.`SchlStud_ID`
		// 						LEFT JOIN `schoolenrollmentsubjectoffered` `off`
		// 							ON FIND_IN_SET(`off`.`SchlEnrollSubjOffSms_ID`,`as`.`SchlAcadSubj_ID`)
		// 						LEFT JOIN `schoolacademicsubject` `sub`
		// 							ON `off`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
		// 						LEFT JOIN `schoolemployee` `em`
		// 							ON `off`.`SchlProf_ID` = `em`.`SchlEmpSms_ID`
		// 						LEFT JOIN `schoolevaluationinformation` `evinfo`
		// 							ON `evinfo`.`SchlAcadLvl_ID` = `as`.`SchlAcadLvl_ID`
		// 				WHERE `as`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
		// 					AND `as`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
		// 					AND `as`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
		// 					AND `st`.`SchlStudSms_ID`=".$SchlStud_ID."
		// 					AND `evinfo`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
		// 					AND `evinfo`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
		// 					AND `evinfo`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
		// 					AND `evinfo`.`SchlEvalInfo_ISOPEN` = 1
		// 					";
		
		
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
						WHERE `SchlStud_ID` = `as`.`SchlStud_ID`
							AND `SchlEvalInfo_ID` = `evinfo`.SchlEvalInfo_ID
							AND `SchlEvalInfo_TBL_ID` = `em`.`SchlEmpSms_ID`
							AND `SchlEvalInfo_TBL_UNIQUE_ID` = `off`.`SchlEnrollSubjOffSms_ID` ORDER BY `SchlEvalvAns_ID` DESC LIMIT 0,1),'') `ANSWER`

				FROM `schoolevaluationinformation` `evinfo`

				LEFT JOIN `schoolenrollmentassessment` `as`
				ON `evinfo`.`SchlAcadLvl_ID` = `as`.`SchlAcadLvl_ID` AND `evinfo`.`SchlAcadYr_ID` = `as`.`SchlAcadYr_ID` AND `evinfo`.`SchlAcadPrd_ID` = `as`.`SchlAcadPrd_ID` 
				LEFT JOIN `schoolenrollmentsubjectoffered` `off`
				ON FIND_IN_SET(`off`.`SchlEnrollSubjOffSms_ID`,`as`.`SchlAcadSubj_ID`)
				LEFT JOIN `schoolacademicsubject` `sub`
				ON `off`.`SchlAcadSubj_ID` = `sub`.`SchlAcadSubjSms_ID`
				LEFT JOIN `schoolemployee` `em`
				ON `off`.`SchlProf_ID` = `em`.`SchlEmpSms_ID`

				WHERE `as`.`SchlStud_ID`=".$SchlStud_ID."
					AND `evinfo`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
					-- AND `evinfo`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
					-- AND `evinfo`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
					AND `evinfo`.`SchlEvalInfo_ID` = ".$SchlEvalInfo_ID."
					AND `evinfo`.`SchlEvalInfo_ISOPEN` = 1
					AND `evinfo`.`SchlEvalInfo_STATUS` = 1
					AND `evinfo`.`SchlEvalInfo_ISACTIVE` = 1
			";

		// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
		// echo var_dump($qry);

	 $rsreg = $dbConn->query($qry);
	 $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	 $rsreg->free_result();
	 $dbConn->close();
	 echo json_encode($fetch);
	  } else if($_GET['mode'] == 'SEARCH_SURVEY_QUESTIONAIRE'){
		$Info_ID =  $_GET['INFOID'];
		$Tbl_ID = $_GET['TBLID'];
		//$status = 1;
		$qry = "SELECT `quest`.`SchlSurvQuest_ID` `ID`,
							    REPLACE(IFNULL(`quest`.`SchlSurvQuest_DESC`,''),',','[||]') `QUESTIONS`,
								`quest`.`SchlSurvQuest_RANKNO` `RANK_NO`,
								`quest`.`SchlSurvQuest_IS_REQUIRED` `QUEST_IS_REQUIRED`,
								IFNULL((SELECT GROUP_CONCAT(
									   CONCAT(
										IFNULL(`SchlSurvQuestChoiceAns_ID`,0),
										'=',
										IFNULL(`SchlSurvQuestChoiceAns_DESC`,''),
										'=',
										IFNULL(`SchlSurvQuestChoiceAns_REMARKS`,'')))
									  FROM `schoolsurveyquestionairechoiceanswer`
									WHERE FIND_IN_SET(
										`SchlSurvQuestChoiceAns_ID`,
										`quest`.`SchlSurvQuestChoiceAns_ID`
										)
									 ORDER BY `SchlSurvQuestChoiceAns_RANKNO`
									),'') `QUEST_CHOICE_ANS`,
								`ans_type`.`SchlSurveyAnsType_CODE` `ANS_TYPE_CODE`,
								`ans_type`.`SchlSurveyAnsType_ID` `ANS_TYPE_ID` 
							FROM `schoolsurveyquestionaire` `quest`
								LEFT JOIN `schoolsurveyanswertype` `ans_type`
									ON `quest`.`SchlSurveyAnsType_ID` = `ans_type`.`SchlSurveyAnsType_ID`
							WHERE `quest`.`SchlSurvInfo_ID` = ".$Info_ID."
							AND `quest`.`SchlSurvInfo_TBL_ID` = ".$Tbl_ID."
							AND `quest`.`SchlSurvQuest_ISACTIVE` = 1
							AND `quest`.`SchlSurvQuest_STATUS` = 1
							ORDER BY `quest`.`SchlSurvQuest_RANKNO`";

		// ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
		// echo var_dump($qry);
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	} else if($_GET['mode'] == 'SEARCH_EVALUATION_QUESTIONAIRE'){
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlEvalInfo_ID = intval($_GET['schlevalinfo_id']);

		$qry = "SELECT 
					IFNULL(`quest`.`SchlEvalQuest_ID`,0) `QUESTIONAIREID`,
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
					IFNULL(`anstype`.`SchlEvalAnsType_ID`,0) `ANSTYPE_ID`,
					`quest`.`SchlEvalQuestChoiceAns_ID`,
					IFNULL((SELECT GROUP_CONCAT(
						CONCAT(
							IFNULL(`SchlEvalQuestChoiceAns_ID`,0),
							'=',
							IFNULL(`SchlEvalQuestChoiceAns_DESC`,0),
							'=',
							IFNULL(`SchlEvalQuestChoiceAns_REMARKS`,'')))
						FROM `schoolevaluationquestionairechoiceanswer`
						WHERE FIND_IN_SET(
							`SchlEvalQuestChoiceAns_ID`,
							`quest`.`SchlEvalQuestChoiceAns_ID`
							)
						ORDER BY `SchlEvalQuestChoiceAns_RANKNO`
						),'') `QUEST_CHOICE_ANS`
					
				FROM `schoolevaluationinformation` `eval`

				-- LEFT JOIN `schoolevaluationquestionaire` `quest`
					-- ON FIND_IN_SET(`quest`.`SchlEvalInfo_TBL_ID`,`eval`.`SchlEvalInfo_TBL_ID`)
				LEFT JOIN `schoolevaluationquestionaire` `quest`
					ON `eval`.`SchlEvalInfo_ID` = `quest`.`SchlEvalInfo_ID`
				LEFT JOIN `schoolevaluationanswertype` `anstype`
					ON `quest`.`SchlEvalAnsType_ID` = `anstype`.`SchlEvalAnsType_ID`
				LEFT JOIN `schoolevaluation` `info`
					ON FIND_IN_SET(`info`.`SchlEval_ID`,`quest`.`SchlEvalInfo_TBL_ID`)
					
				WHERE `eval`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID."
						-- AND `eval`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID."
						-- AND `eval`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
						AND `eval`.`SchlEvalInfo_ID` = ".$SchlEvalInfo_ID."
						AND `eval`.`SchlEvalInfo_ISOPEN` = 1
						AND `eval`.`SchlEvalInfo_STATUS` = 1
						AND `eval`.`SchlEvalInfo_ISACTIVE` = 1
						AND `quest`.`SchlEvalQuest_STATUS` = 1
						AND `quest`.`SchlEvalQuest_ISACTIVE` = 1
									;";

	//   ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
	//   echo var_dump($qry);
	  $rsreg = $dbConn->query($qry);
	  $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	  $rsreg->free_result();
	  $dbConn->close();
	  echo json_encode($fetch);
	} else if($_GET['mode'] == 'INSERT_SURVEY'){
		$mode = mysqli_real_escape_string($dbConn, 'INSERT');   
	  $schlsurvans_answer = mysqli_real_escape_string($dbConn, $_GET['schlsurvans_answer']);  
	  $schlsurvinfo_id = intval($_GET['schlsurvinfo_id']);
	  $schlsurvinfo_tbl_id = intval($_GET['schlsurvinfo_tbl_id']);  
	  $schlsurvinfo_comments = mysqli_real_escape_string($dbConn, $_GET['schlsurvinfo_comments']);  
	  $schlstud_id = intval($_SESSION['USERID']); 
	  
	  //$status = 1;
	//   $qry = "CALL spMANAGESchoolSurveyAnswer('".$mode."','".$schlsurvans_answer."','".$schlsurvinfo_comments."',".$schlsurvinfo_id.",".$schlsurvinfo_tbl_id.",".$schlstud_id.")";
	  $qry = "CALL `spMANAGESchoolFormsAnswers`('survey', '$schlsurvinfo_comments', '$schlsurvans_answer', $schlstud_id,$schlsurvinfo_id,$schlsurvinfo_tbl_id,0,0);";

	    // ini_set('xdebug.var_display_max_data', -1); // Set to -1 for unlimited data display
	    // echo var_dump($qry);
	  $rsreg = $dbConn->query($qry);
	  $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
	  $rsreg->free_result();
	  $dbConn->close();
	  echo json_encode($fetch);
      
	  } else if($_GET['mode'] == 'INSERT_EVALUATION'){
		$mode = mysqli_real_escape_string($dbConn, 'INSERT');  
		$schlevalans_answer = mysqli_real_escape_string($dbConn, $_GET['schlevalans_answer']);  
		$schlevalinfo_id = intval($_GET['schlevalinfo_id']);
		$schlevalnfo_tbl_id = intval($_GET['schlevalinfo_tbl_id']);  
		$schlevalnfo_tbl_unique_id = intval($_GET['schlevalinfo_tbl_unique_id']);  
		$schlstud_id = intval($_SESSION['USERID']); 
		$schlevalans_comments = mysqli_real_escape_string($dbConn, $_GET['schlevalans_comments']);  
		//$status = 1;
		// $qry = "CALL spMANAGESchoolEvaluationAnswer('".$mode."','".$schlevalans_answer."','".$schlevalans_comments."',".$schlevalinfo_id.",".$schlevalnfo_tbl_id.",".$schlevalnfo_tbl_unique_id.",".$schlstud_id.")";
		$qry = "CALL `spMANAGESchoolFormsAnswers`('evaluation', '$schlevalans_comments', '$schlevalans_answer', $schlstud_id,$schlevalinfo_id,0,$schlevalnfo_tbl_id,$schlevalnfo_tbl_unique_id);";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	  }
  }
?>