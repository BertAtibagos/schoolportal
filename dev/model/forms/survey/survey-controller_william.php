<?php
   if(session_status() === PHP_SESSION_NONE){
		session_start();
	}
  require_once '../../configuration/connection-config.php';
  
  if(isset($_GET['mode'])){
	  if ($_GET['mode'] == 'SEARCH')
	  {
		// $SchlAcadLvl_ID =  $_SESSION['LVLID'];//1;//intval($_SESSION['LVLID']);//intval($_GET['lvlid']);  
		// $SchlAcadYr_ID = $_SESSION['YRID'];//5;//intval($_SESSION['YRID']);//intval($_GET['yrid']);  
		// $SchlAcadPrd_ID = $_SESSION['PRDID'];//1;//intval($_SESSION['PRDID']);//intval($_GET['prdid']);  
		// $SchlAcadYrLvl_ID = $_SESSION['YRLVLID'];//5;//intval($_SESSION['YRLVLID']);//intval($_GET['yrlvlid']);  
		// $SchlAcadCrses_ID = $_SESSION['CRSEID'];//72;//intval($_SESSION['CRSEID']);//intval($_GET['crseid']);  
		// $SchlAcadSec_ID = 0;$_SESSION['SECID'];//0;//intval($_SESSION['SECID']);//intval($_GET['secid']);  
		// $SchlStud_ID = intval($_SESSION['USERID']);
		// //echo $_SESSION['LVLID'];
		// $qry = "CALL spGETSurveyInformation(".$SchlAcadLvl_ID.",".$SchlAcadYr_ID.",".$SchlAcadPrd_ID.",".$SchlAcadYrLvl_ID.",".$SchlAcadCrses_ID.",".$SchlAcadSec_ID.",".$SchlStud_ID.")";
		// $rsreg = $dbConn->query($qry);
		// $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		// $rsreg->free_result();
		// $dbConn->close();
		// echo json_encode($fetch);
	   } else if($_GET['mode'] === 'SEARCH_DEPARTMENT'){
		$SchlAcadLvl_ID =  $_SESSION['LVLID'];
		$SchlAcadYr_ID = $_SESSION['YRID'];
		$SchlAcadPrd_ID = $_SESSION['PRDID'];
		$SchlStud_ID = intval($_SESSION['USERID']);
		
		$qry = "SELECT `dept`.`SchlDeptSms_ID` `ID`,
						`dept`.`SchlDept_DESC` `DESC`,
						`survey`.`SchlSurvInfo_DESC` `SURVEY_INFO_DESC`,
						`survey`.`SchlSurvInfo_ID` `SURVEY_INFO_ID`,
						IFNULL((SELECT GROUP_CONCAT(
								CONCAT(`SchlSurvInfo_ID`,':',`dept`.`SchlDeptSms_ID`,'[||]',`SchlSurvAns_ANSWER`)) 
								   FROM `schoolsurveyanswer`
							 WHERE `SchlStud_ID` = ".$SchlStud_ID."
								AND `SchlSurvInfo_ID` = `survey`.`SchlSurvInfo_ID`
								AND `SchlSurvInfo_TBL_ID` = `dept`.`SchlDeptSms_ID`),'') `ANSWER`
						FROM `schooldepartment` `dept`
							LEFT JOIN `schoolsurveyinformation` `survey`
								ON FIND_IN_SET(`dept`.`SchlDeptSms_ID`,
									(SELECT `SchlSurvInfo_TBL_ID` FROM `schoolsurveyinformation` 
										WHERE `SchlAcadLvl_ID` = `survey`.`SchlAcadLvl_ID` 
											AND `SchlAcadYr_ID` = `survey`.`SchlAcadYr_ID`  
											AND `SchlAcadPrd_ID` = `survey`.`SchlAcadPrd_ID` 
											AND `SchlSurvInfo_ISOPEN` = 1))
						WHERE `dept`.`SchlDept_ISACADEMIC` = 0
							AND `survey`.`SchlAcadLvl_ID` = ".$SchlAcadLvl_ID." 
							AND `survey`.`SchlAcadYr_ID` = ".$SchlAcadYr_ID." 
							AND `survey`.`SchlAcadPrd_ID` = ".$SchlAcadPrd_ID."
							AND `survey`.`SchlSurvInfo_ISOPEN` = 1;";

		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	  } else if($_GET['mode'] == 'SEARCH_QUESTIONAIRE'){
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
							ORDER BY `quest`.`SchlSurvQuest_RANKNO`";

		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	  } else if($_GET['mode'] == 'INSERT'){
		$mode = mysqli_real_escape_string($dbConn, $_GET['mode']);  
		$schlsurvans_answer = mysqli_real_escape_string($dbConn, $_GET['schlsurvans_answer']);  
		$schlsurvinfo_id = intval($_GET['schlsurvinfo_id']);
		$schlsurvsnfo_tbl_id = intval($_GET['schlsurvinfo_tbl_id']);  
		$schlstud_id = intval($_SESSION['USERID']); 
		
		//$status = 1;
		$qry = "CALL spMANAGESchoolSurveyAnswer('".$mode."','".$schlsurvans_answer."',".$schlsurvinfo_id.",".$schlsurvsnfo_tbl_id.",".$schlstud_id.")";
		$rsreg = $dbConn->query($qry);
		$fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
		$rsreg->free_result();
		$dbConn->close();
		echo json_encode($fetch);
	  }
  }
?>