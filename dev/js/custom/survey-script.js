$(document).ready(function() 
{
	var surveyInfoDESC = [];
	var surveyInfoID = [];
	var surveyInfoCategory = [];
	var surveyInfoAnswer = [];
	var surveyTblID = [];
	var surveyTblNAME = [];
	var ctrlrequired = [];
	var ctrldiv = [];
	var ctrlcreated = [];
	var tblitemid = [];
	
	var btnview;
	var tblid;
	
	var tblrowid;
	var tbluniqueid;

	
	var questionaireRANKNO = [];
	var questionaireID = [];
	var questionaire = [];
	var questionaireISREQUIRED = [];
	
	var choicesREMARKS = [];
	var choicesID = [];
	var choices = [];
	var answerTYPE = [];
	
	var categoryID = [];
	
	var ctrlrequired = [];
	var ctrldiv = [];
	var ctrlcreated = [];
	var evaluationID = [];
	var evaluationDESC = [];
	
	var evaltblrowid;
	var tblid;
	var tbluniqueid;
	var evaluationinfoid;
	
	function ViewListOfSurvey()
	{
		$.ajax({
			type:'GET',
			url: '../../model/forms/survey/survey-controller.php',
			data:{
				mode : 'SEARCH_SURVEY'
			},
			beforeSend: function(){
					$('#section-surv-main').css("cursor", "wait");
			},
			success: function(result)
			{	
				var rsstudJSON = JSON.parse(result);
				var survey_info_id = 0;
				var survey_tbl_name = '';
				var survey_col_name = '';
				var survey_col_desc = '';
				var survey_tbl_id = 0;
				var survey_builder = "";
				
				if(rsstudJSON.length > 0){
					survey_builder += '<h2 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>Survey</center><h2>';
					survey_builder += '<table id="" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto;">';
					$.each(rsstudJSON, function(key, value) {
						survey_info_id = value.SURVEY_INFO_ID;
						survey_tbl_name = value.SURVEY_TBL_NAME;
						survey_col_name = value.SURVEY_COL_NAME;
						survey_col_desc = value.SURVEY_COL_DESC;
						survey_tbl_id = value.SURVEY_TBL_ID;

						survey_builder += '<tbody id="nav-tab" class="survey-tab-' + value.SURVEY_INFO_ID + '">';
						survey_builder += '<tr>';
						survey_builder += '	<td colspan="2" style="width: auto;height: auto;text-align: left;font-size: 16px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;" id="td-' + value.SURVEY_INFO_ID + '">';
						survey_builder += 		value.SURVEY_INFO_DESC;
						survey_builder += '	</td>';
						survey_builder += '	<td style="height: auto;" class="col-md-2">';
						survey_builder += '		<button type="button"  style="font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none;" class="btn btn-block btn-primary btn-view-survey" id="btnview-question-' + value.SURVEY_INFO_ID +'" value="' + value.SURVEY_INFO_ID + '--' + value.SURVEY_TBL_NAME + '--' + value.SURVEY_COL_NAME + '--' + value.SURVEY_COL_DESC + '--' + value.SURVEY_TBL_ID + '">View</button>';
						survey_builder += '	</td>';
						survey_builder += '</tr>';
						survey_builder += '</tbody>';
					});
						survey_builder += '</table>';
				} else {
					survey_builder += '<h2 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>Survey</center><h2>';
					survey_builder += '<table id="" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto;">';
					survey_builder += '<tbody id="nav-tab"><tr>';
					survey_builder += '<td colspan="99" style="text-align: center; font-size: 20px;font-weight: bold; text-decoration: none; color: red;">';
					survey_builder += 'NO SURVEY AVAILABLE';
					survey_builder += '</td>';
					survey_builder += '</tr>';
					survey_builder += '</tbody>';
					survey_builder += '</table>';
				}

				$('#section-surv-main').css("cursor", "default");
				$('#list-survey').html(survey_builder);
				$('#div-process').html('');

				$('body').on('click', '.btn-view-survey', function(){
					var arr_qry = $(this).val().split('--');
					var info_id = arr_qry[0];
					var tbl_name = arr_qry[1];
					var col_name = arr_qry[2];
					var col_desc = arr_qry[3];
					var tbl_id = arr_qry[4];
					
					$.ajax({
						type:'GET',
						url: '../../model/forms/survey/survey-controller.php',
						data:{
							mode : 'SEARCH_PER_SURVEY',
							survey_info_id : info_id,
							survey_tbl_name : tbl_name,
							survey_col_name : col_name,
							survey_col_desc : col_desc,
							survey_tbl_id : tbl_id
						},
						beforeSend: function(){
								$('#section-surv-main').css("cursor", "wait");
						},
						success: function(result)
						{	
							$('#div-list').hide();
							$('#div-survey-header').show();
							var surveyJSON = JSON.parse(result);
							// console.log(surveyJSON);

							var survey_builder_2 = '';
							survey_builder_2 += '<button type="button" style="float: right;width: auto; height: auto;" class="btn btn-block btn-danger" id="btn-close-list">X</button> ';
							survey_builder_2 += '<h2 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>Survey</center><h2>';
							survey_builder_2 += '<table id="" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto; margin-top: 2rem;">';
							for (var i = 0; i < surveyJSON.length; i++) {
								var item = surveyJSON[i];

								survey_builder_2 += '<tr>';
								survey_builder_2 += '<td  colspan="2" style="width: auto;height: auto;text-align: left;font-size: 16px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;" id="td-' + item.ID + '">';
								survey_builder_2 += item.DESC;
								survey_builder_2 += '</td>';
								if (item.ANSWER.length > 0)
								{
									survey_builder_2 += '<td class="img" style="width: auto;height: auto;">';
									//survey_builder_2 += '<button type="button"  style="font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none;" class="btn btn-block btn-success btn-view-questions" id="' + icat_id_cat2[0].toString() + '" item="' + icat_id_cat2[0].toString() + '">View</button>';	
									survey_builder_2 += '</td>';
								} else {
									survey_builder_2 += '<td style="height: auto;" class="col-md-2">';
									survey_builder_2 += '<button type="button"  style="font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none;" class="btn btn-block btn-primary btn-survey-questions" id="btnview-question-' + info_id + '-' + item.ID + '" value="' + item.ID + '">Survey</button>';		
									survey_builder_2 += '</td>';
								}
								survey_builder_2 += '</tr>';
							};
							survey_builder_2 += '</table>';
							
							$('#main-survey').html(survey_builder_2);
							ViewListOfSurveyQuestion();
							$('#section-surv-main').css("cursor", "default");
						},
						error:function(status){
							$('#errormessage').html('Error!');
							$('#section-surv-main').css("cursor", "default");
							$('#div-process').html('');
						}
					});
				});
			},
			error:function(status){
				$('#errormessage').html('Error!');
				$('#section-surv-main').css("cursor", "default");
				$('#div-process').html('');
			}
		});

		$.ajax({
			type:'GET',
			url: '../../model/forms/survey/survey-controller.php',
			data:{
				mode : 'SEARCH_EVALUATION'
			},
			beforeSend: function(){
					$('#section-surv-main').css("cursor", "wait");
			},
			success: function(result){
				var rsstudJSON = JSON.parse(result);
				
				var evaluation_builder = "";
				if(rsstudJSON.length > 0){
					evaluation_builder += '<h2 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>Evaluation</center><h2>';
					evaluation_builder += '<table id="" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto;">';
					$.each(rsstudJSON, function(key, value) {
						evaluation_builder += '<tbody id="nav-tab" class="survey-tab-' + value.EVAL_INFO_ID + '">';
						evaluation_builder += '<tr>';
						evaluation_builder += '	<td colspan="2" style="width: auto;height: auto;text-align: left;font-size: 16px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;" id="td-' + value.EVAL_INFO_ID + '">';
						evaluation_builder += 		value.EVAL_INFO_DESC;
						evaluation_builder += '	</td>';
						evaluation_builder += '	<td style="height: auto;" class="col-md-2">';
						evaluation_builder += '		<button type="button"  style="font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none;" class="btn btn-block btn-primary btn-view-evaluation" id="btnview-question-' + value.EVAL_INFO_ID +'" value="' + value.EVAL_INFO_ID + '">View</button>';
						evaluation_builder += '	</td>';
						evaluation_builder += '</tr>';
						evaluation_builder += '</tbody>';
					});
					evaluation_builder += '</table>';

				} else {
					var evaluation_builder = "";
					evaluation_builder += '<h2 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>Evaluation</center><h2>';
					evaluation_builder += '<table id="" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto;">';
					evaluation_builder += '<tbody id="nav-tab"><tr>';
					evaluation_builder += '<td colspan="2" style="text-align: center; font-size: 20px; font-weight: bold; text-decoration: none; color: red;">';
					evaluation_builder += 'NO EVALUATION AVAILABLE';
					evaluation_builder += '</td>';
					evaluation_builder += '</tr>';
					evaluation_builder += '</tbody>';
					evaluation_builder += '</table>';
				}
				$('#section-surv-main').css("cursor", "default");
				$('#list-evaluation').html(evaluation_builder);
				$('#div-process').html('');

				$('body').on('click', '.btn-view-evaluation', function(){
                    let infoid = $(this).val();
					$.ajax({
						type:'GET',
						url: '../../model/forms/survey/survey-controller.php',
						data:{
							mode : 'SEARCH_PER_EVALUATION',
                            infoid : infoid
						},
						success: function(result){
							$('#div-list').hide();
							$('#div-survey-header').show();
							var rsstudJSON = JSON.parse(result);

							var evaluation_builder_2 = '';
							evaluation_builder_2 += '<button type="button" style="float: right;width: auto; height: auto;" class="btn btn-block btn-danger" id="btn-close-list">X</button> ';
							evaluation_builder_2 += '<h4 style="padding-top: 1rem; color: black;text-decoration: underline;"><center>' + rsstudJSON[0].EVAL_INFO_NAME + '</center></h4>';
							evaluation_builder_2 += '<table id="eval-tab" class="table table-hover table-responsive table-bordered" style="width: 100%;height: auto; margin-top: 2rem;">';
									
							evaluation_builder_2 += '<thead class="table-primary" style="font-size: 12px; font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;">';
							evaluation_builder_2 += '<tr>';
							evaluation_builder_2 += '<th scope="col" style="font-size: 13px;color: darkblue;">SUBJECT</th>';
							evaluation_builder_2 += '<th scope="col" style="font-size: 13px;color: darkblue;">INSTRUCTOR</th>';
							evaluation_builder_2 += '<th scope="col" style="font-size: 13px;color: darkblue;"></th>';
							evaluation_builder_2 += '</tr>';
							evaluation_builder_2 += '</thead>';					
							evaluation_builder_2 += '<tbody id="nav-tab">';
							
							for(i = 0; i< rsstudJSON.length; i++)
							{ 
								evaluation_builder_2 += '<tr>';
								evaluation_builder_2 += '<td style="width: auto;height: auto;text-align: left; font-size: 12px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;" id="td-' + rsstudJSON[i].TBL_UNIQUE_ID + '">';
								evaluation_builder_2 += (rsstudJSON[i].SUBJ_DESC === undefined? '' : rsstudJSON[i].SUBJ_DESC.replace('[||]',', '));
								evaluation_builder_2 += '</td>';
								evaluation_builder_2 += '<td style="width: auto;height: auto;text-align: left; font-size: 12px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: black;" id="td-' + rsstudJSON[i].TBL_ID + '">';
								evaluation_builder_2 += (rsstudJSON[i].EMP_NAME === undefined? '' : rsstudJSON[i].EMP_NAME.replace('[||]',', '));
								evaluation_builder_2 += '</td>';
								if (rsstudJSON[i].EMP_NAME != 'NONE')
								{
									if (rsstudJSON[i].ANSWER.length > 0)
									{
										evaluation_builder_2 += '<td class="img" style="width: auto;height: auto;">';
										evaluation_builder_2 += '</td>';
									} else {
										evaluation_builder_2 += '<td class="" style="width: auto;height: auto;">';
										evaluation_builder_2 += '<button type="button"  style="font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none;" class="btn btn-block btn-primary btn-evaluation-questions" id="btnevalid-' + rsstudJSON[i].EVAL_INFO_ID + '" name="btnevalname-'+ rsstudJSON[i].TBL_ID + '"  value="' + rsstudJSON[i].TBL_UNIQUE_ID + '">Evaluate</button>';		
										evaluation_builder_2 += '</td>';
									}
								} else {
									evaluation_builder_2 += '<td class="" style="width: auto;height: auto;font-style: italic;  font-size: 14px;font-family: Roboto, sans-serif; font-weight: normal; text-decoration: none; color: red;">';
									evaluation_builder_2 += 'No Instructor';	
									evaluation_builder_2 += '</td>';
								}
								evaluation_builder_2 += '</tr>';
							}
							evaluation_builder_2 += '</tbody>';
							evaluation_builder_2 += '</table>';
							$('#main-evaluation').html(evaluation_builder_2);
							ViewListOfEvaluationQuestion();

							$('#section-surv-main').css("cursor", "default");
						},
						error:function(status){
							$('#errormessage').html('Error!');
							$('#section-surv-main').css("cursor", "default");
							$('#div-process').html('');
						}
					});
				});
			},
			error:function(status){
				$('#errormessage').html('Error!');
				$('#section-surv-main').css("cursor", "default");
				$('#div-process').html('');
			}
		});
	}
	
	function ViewListOfSurveyQuestion()
	{
		$('.btn-survey-questions').on('click',function() 
		{
			var id = $(this).val();//Department ID
			var name = $(this).attr('id');
			var name_arr = name.split('-');
			tblid = id;
			btnview = $(this);
			var html_question_choices = '';
			var html_question_tag = '';

			$('#div-survey-header').hide();
			$('#div-survey-content').show();

			var cRow=$(this).closest("tr");
			//tblrowid = $(this).closest("tr");
			tblrowid = cRow.find("td:eq(1)");
			$('#hd-survey-content').html(cRow.find("td:eq(0)").html());
			$('#hd-survey-description').html('&emsp;&emsp;&emsp;&emsp;Greetings FCPCians! To improve the quality of services we provide, we would like you to accomplish the survey as honest and constructive as possible. Your responses will be treated confidential.');
			
			$.ajax({
				type:'GET',
				url: '../../model/forms/survey/survey-controller.php',
				data:{
					mode : 'SEARCH_SURVEY_QUESTIONAIRE',
					INFOID : name_arr[2],
					TBLID : id
				},
				success: function(result)
				{
					var rsstudJSON = JSON.parse(result);
					if (rsstudJSON.length > 0)
					{
						$.each(rsstudJSON, function(key, value) 
						{
							html_question_tag += '<div id="div-survey-' + value.ID + '" style="padding-inline: 1rem;">';

							if(value.RANK_NO == 0){
								html_question_tag += '<p>' +  
														'' + value.QUESTIONS.replace('[||]',', ') + ' ' +
														'<span>' + (value.QUEST_IS_REQUIRED.toString() == '0' ? '' : ' (Required)') + '</span>';
								html_question_tag += '</p>';
							} else {
								html_question_tag += '<p>' + 
														value.RANK_NO + 
														'.   ' + 
														'' + value.QUESTIONS.replace('[||]',', ') + ' ' +
														'<span>' + (value.QUEST_IS_REQUIRED.toString() == '0' ? '' : ' (Required)') + '</span>';
								html_question_tag += '</p>';
								
							}
							
							html_question_choices = '';
								var ac = value.QUEST_CHOICE_ANS.split(',');
								//var id = '';
								for(iac=0; iac < ac.length; iac++){
									var ac_id_desc = ac[iac].split('=');
										html_question_choices += (value.ANS_TYPE_CODE.toString() === 'SINGLE' ?
																	'<div style="display: inline-flex;"><input type="radio" '
																	:
																	(value.ANS_TYPE_CODE.toString() === 'MULTIPLE' ?
																		'<div style="display: inline-flex;"><input type="checkbox" '
																		:
																		'<div style="display: inline-flex;"><textarea '));
										html_question_choices += 'id="' + name_arr[2] + 
																 '-' + value.ID + 
																 '-' + value.ANS_TYPE_ID.toString() + 
																 '-' + ac_id_desc[0].toString() + '" ';
										html_question_choices += (value.ANS_TYPE_CODE.toString() === 'SINGLE' ?
																	'name="' + value.ID + '" value="' + ac_id_desc[0].toString() + '"/><label for='+ name_arr[2] + 
																	'-' + value.ID + 
																	'-' + value.ANS_TYPE_ID.toString() + 
																	'-' + ac_id_desc[0].toString() + '>' + ac_id_desc[1].toString() + '   ' + ac_id_desc[2].toString() + '</label></div>'
																	:
																	(value.ANS_TYPE_CODE.toString() === 'MULTIPLE' ?
																		'name="' + value.ID + '-' + ac_id_desc[0].toString() + '" value="' + ac_id_desc[0].toString() + '"/><label for='+ name_arr[2] + 
																		'-' + value.ID + 
																		'-' + value.ANS_TYPE_ID.toString() + 
																		'-' + ac_id_desc[0].toString() + '>' + ac_id_desc[1].toString() + '   ' + ac_id_desc[2].toString() + '</label></div>'
																		:
																		'name="txtarea-' + value.ID + '" rows="4" cols="80" ' + (value.QUEST_IS_REQUIRED.toString() == '0' ? '' : 'required') + '></textarea></div>'));
									// html_question_choices += '</br>';
								}
							html_question_tag = html_question_tag + html_question_choices;
							html_question_tag += '</div>';
							html_question_tag += '<hr style="color: black;">';
							html_question_tag += '<br>';
							// html_question_tag += '<hr>';
							ctrlcreated.push((value.ANS_TYPE_CODE.toString() === 'SINGLE' ?
												'input[name="' + value.ID + '"]'
												:
												(value.ANS_TYPE_CODE.toString() === 'MULTIPLE' ?
													'input[name="' + value.ID + '"]'
													:
													'#txtarea-' + value.ID)));
							ctrldiv.push('#div-survey-' + value.ID);
							if (value.QUEST_IS_REQUIRED.toString() === '1'){
									ctrlrequired.push((value.ANS_TYPE_CODE.toString() == 'SINGLE' ?
												'input[name="' + value.ID + '"]'
												:
												(value.ANS_TYPE_CODE.toString() == 'MULTIPLE' ?
													'input[name="' + value.ID + '"]'
													:
													'#txtarea-' + value.ID)));
													//alert(icat_id_cat1[1].toString());
							}
						});
						html_question_tag += '<br><center><p style="font-size: 22px; font-weight: bold; font-style: none; color: green;">COMMENTS & SUGGESTIONS:</p><textarea id="txtarea-comments" name="txtarea-comments" maxlength="1000" style="width: 100%; height: 10rem; padding: .5rem;" placeholder="Write your comments here.."></textarea><center>';
						html_question_tag += '<br><center><button type="button" style="padding-inline: 2rem; font-size: 16px;font-family: Roboto, sans-serif; font-weight: bold;" class="btn btn-block btn-primary" id="btn-submit-survey" name="btn-submit-survey">Proceed</button><center>';
						$('#main-content').html(html_question_tag);
						// SubmitSurvey();

						$('#btn-submit-survey').click(function(){
							for(x = 0; x< ctrlrequired.length; x++)
							{
								if (!$(ctrlrequired[x]).is(':checked'))
								{
									$(ctrldiv[x]).css('border', '2px solid red');
									$(ctrldiv[x]).css('border-radius', '0.5rem');
									$(ctrlrequired[x]).focus();
									return;
								} else {
									$(ctrldiv[x]).css('border', '0px none transparent');
								}
							}
							var _finalans_arr = [];
							var _finalans = '';
							var _survinfo_id = 0;
							for(x = 0; x< ctrlcreated.length; x++)
							{
								var iddiv = ctrldiv[x].split('-');
								_perquestion = iddiv[2].toString() + '=' + $(ctrlcreated[x] + ':checked').val().replace(/[^a-zA-Z0-9. ]/g, '');
								_survinfo_id = $(ctrlcreated[x]).attr('id');
								
								// console.log(_perquestion);
								if (!_finalans_arr.includes(_perquestion)) {
									_finalans_arr.push(_perquestion);
								}
							}

							var _comments =  $('#txtarea-comments').val().replace(/[^a-zA-Z0-9. ]/g, '');
							_finalans = _finalans_arr.join(',');

							// console.log(_finalans)
							// console.log(_finalans_arr)
							// console.log(_finalans.substring(1, (_finalans.length)));
							// console.log(_survinfo_id);
							// console.log(tblid);

							$.ajax({
									async: false,
									mode:'GET',
									url: '../../model/forms/survey/survey-controller.php',
									data:{
										mode : 'INSERT_SURVEY',
										schlsurvans_answer: _finalans,
										schlsurvinfo_id : _survinfo_id,
										schlsurvinfo_tbl_id: tblid,
										schlsurvinfo_comments: _comments
									},
									success: function(result){
										//var _tdrw = tblrowid.find("td:eq(1)");
										//var _btnSurvey=_tdrw.find("button");
										var _btnSurvey= tblrowid.find("button");
										_btnSurvey.remove();
										//_btnSurvey.hide();
										tblrowid.addClass('img');
										$('#btn-close-survey-content').click();
										ctrlcreated = [];
										ctrldiv = [];
										ctrlrequired  = [];
										alert('Submit Successful.');
									},
									error: function(){
										alert('Failed to submit, Click the submit button again.');
									}
							});
						});
					} else {
						$('#main-content').html('<center><div style="font-size: 20px; font-weight: bold; font-style: italic; text-decoration: none;color: red;">NO ASSIGNED QUESTIONAIRE</div></center>');
					}
				},
				error:function(status){
					$('#errormessage').html('Error!');
				}
			});
		});
	}
	function ViewListOfEvaluationQuestion()
	{
		$('.btn-evaluation-questions').on('click',function()
		{
			var id = $(this).val();
			var str = $(this).attr('name').split('-');
			evaluationinfoid = $(this).attr('id').split('-');
			tbluniqueid = id;
			tblid = str[1];
			var html_question_tag = '';
			var cRow=$(this).closest("tr");
			//tblrowid = $(this).closest("tr");
			evaltblrowid = cRow.find("td:eq(2)");
			$('#hd-survey-content').html(cRow.find("td:eq(1)").html());
			$('#hd-survey-description').html('&emsp;&emsp;&emsp;&emsp;As part of the continuous improvement culture of our school, we would like you to accomplish this evaluation instrument as honest and constructive as possible. Rest assured that your responses will be treated with confidentiality. Kindly rate the following items according to the degree of your agreement.');
			
			$('#div-survey-header').hide();
			$('#div-survey-content').show();
			
			$.ajax({
				mode:'GET',
				url: '../../model/forms/survey/survey-controller.php',
				data:{
					mode : 'SEARCH_EVALUATION_QUESTIONAIRE',
					schlevalinfo_id : evaluationinfoid[1]
				},
				beforeSend: function(){
					$('#section-surv-main').css("cursor", "progress");
				},
				success: function(result)
				{
					var rsQuestions = JSON.parse(result);
					if (rsQuestions.length > 0)
					{	
						var groupedData = {};
						
						$.each(rsQuestions, function(index, item) {
							var category = item.CATEGORY;

							if (!groupedData[category]) {
								groupedData[category] = [];
							}
							groupedData[category].push(item);
						});

						$.each(groupedData, function(categoryId, categoryItems) {
							html_question_tag += '<div id="div-eval-category" style="font-size: 22px; font-weight: bold; font-style: none; color: green;">(' + categoryId + ')'; 

							$.each(categoryItems, function(index, value) {
								//do the code here
								
								html_question_tag += '<div id="div-eval-' + value.QUESTIONAIREID + '" style="color: black;">';
								html_question_tag += '<p>' + 
														value.QUEST_RANKNO + 
														'.   ' + 
														' ' + value.QUESTIONAIRE.replace('[||]',', ') + ' ' +
														'<span>' + (value.QUEST_IS_REQUIRED.toString() == '0' ? '' : ' (Required)') + '</span>';
								html_question_tag += '</p>';

								var choices_arr = value.QUEST_CHOICE_ANS.split(',');
								$.each(choices_arr, function(key, item) {
									var choices_info = choices_arr[key].split('=');
									var choices_id = choices_info[0];
									var choices_desc = choices_info[1];
									var choices_remaks = choices_info[2];

									var html_question_choices = '';

									html_question_choices += (value.ANSTYPE_DESC.toString() === 'SINGLE' ?
																'<div style="display: inline-flex; font-weight: normal; font-size: 16px;"><input type="radio" '
																:
																(value.ANSTYPE_DESC.toString() === 'MULTIPLE' ?
																	'<div style="display: inline-flex; font-weight: normal; font-size: 16px;"><input type="checkbox" '
																	:
																	'<div style="display: inline-flex; font-weight: normal; font-size: 16px; width: 100%;"><textarea '));
									html_question_choices += 'id="ans-' + value.QUESTIONAIREID.toString() + 
																'-' + value.CATEGORY_ID.toString() + 
																'-' + choices_id.toString()  + 
																'-' + tbluniqueid + '" ';
									html_question_choices += (value.ANSTYPE_DESC.toString() === 'SINGLE' ?
																'name="ans-' + value.QUESTIONAIREID.toString() + '" value="' + choices_id.toString() + '"/><label for="ans-'+ value.QUESTIONAIREID.toString() + 
																'-' + value.CATEGORY_ID.toString() + 
																'-' + choices_id.toString()  + 
																'-' + tbluniqueid +'">' + choices_desc.toString() + '   ' + choices_remaks.toString() + '</label></div>'
																:
																(value.ANSTYPE_DESC.toString() === 'MULTIPLE' ?
																	'name="ans-' + value.QUESTIONAIREID.toString() + '" value="' + choices_id.toString() + '"/><label for="ans-'+ value.QUESTIONAIREID.toString() + 
																	'-' + value.CATEGORY_ID.toString() + 
																	'-' + choices_id.toString()  + 
																	'-' + tbluniqueid +'">' + choices_desc.toString() + '   ' + choices_remaks.toString() + '</label></div>'
																	:
																	'name="txtarea-' + value.QUESTIONAIREID.toString() + '" maxlength="1000" style="width: 100%; height: 5rem; padding: .5rem;" ' + (value.QUEST_IS_REQUIRED.toString() == '0' ? '' : 'required') + '></textarea></div>'));
												
									ctrlcreated.push((value.ANSTYPE_DESC.toString() === 'SINGLE' ?
														'input[name="ans-' + value.QUESTIONAIREID.toString() + '"]'
														:
														(value.ANSTYPE_DESC.toString() === 'MULTIPLE' ?
															'input[name="ans-' + value.QUESTIONAIREID.toString() + '"]'
															:
															'textarea[name="txtarea-' + value.QUESTIONAIREID.toString() + '"]')));
									ctrldiv.push('#div-eval-' + value.QUESTIONAIREID);
									if (value.QUEST_IS_REQUIRED.toString() == '1'){
											ctrlrequired.push((value.ANSTYPE_DESC.toString() === 'SINGLE' ?
														'input[name="ans-' + value.QUESTIONAIREID.toString() + '"]'
														:
														(value.ANSTYPE_DESC.toString() === 'MULTIPLE' ?
															'input[name="ans-' + value.QUESTIONAIREID.toString() + '"]'
															:
															'textarea[name="txtarea-' + value.QUESTIONAIREID.toString() + '"]')));
															//alert(icat_id_cat1[1].toString());
									}
									html_question_tag = html_question_tag + html_question_choices;
								});
																							
								html_question_tag += '</div>';
								html_question_tag += '<hr style="color: black;">';
								html_question_tag += '<br>';
								
							});
							
							html_question_tag += '</div>';
								
						});
						// console.log(html_question_tag);
						html_question_tag += '<br><center><p style="font-size: 22px; font-weight: bold; font-style: none; color: green;">COMMENTS & SUGGESTIONS:</p><textarea id="txtarea-comments" name="txtarea-comments" maxlength="1000" style="width: 100%; height: 10rem; padding: .5rem;" placeholder="Write your comments and suggestions to the teacher here.."></textarea><center>';
						html_question_tag += '<br><br><br><center><button type="button" style="padding-inline: 2rem; font-size: 16px; font-family: Roboto, sans-serif; font-weight: bold;" class="btn btn-block btn-primary" id="btn-submit-evaluation">Proceed</button><center>';

						$('#section-surv-main').css("cursor", "default");
						$('#main-content').html(html_question_tag);
						
						// for(i = 0; i< rsQuestions.length; i++)
						// {   
						// 	if(questionaire.indexOf(rsQuestions[i].QUESTIONAIRE) == -1){
						// 		questionaire.push(rsQuestions[i].QUESTIONAIRE);
						// 		questionaireID.push(rsQuestions[i].QUESTIONAIREID);
						// 		questionaireRANKNO.push(rsQuestions[i].QUEST_RANKNO);
						// 		questionaireISREQUIRED.push(rsQuestions[i].QUEST_IS_REQUIRED);
						// 		answerTYPE.push(rsQuestions[i].ANSTYPE_DESC);
						// 		categoryID.push(rsQuestions[i].CATEGORY_ID);
						// 	}
						// 	if(evaluationDESC.indexOf(rsQuestions[i].CATEGORY) == -1){
						// 		evaluationDESC.push(rsQuestions[i].CATEGORY);
						// 		evaluationID.push(rsQuestions[i].CATEGORY_ID);
						// 	}
							
						// 	if(choices.indexOf(rsQuestions[i].CHOICES_DESC) == -1){
						// 		choices.push(rsQuestions[i].CHOICES_DESC);
						// 		choicesREMARKS.push(rsQuestions[i].CHOICES_REMARKS);
						// 		choicesID.push(rsQuestions[i].CHOICES_ID);
						// 	}
						// }
						// for(v=0; v < evaluationDESC.length; v++)
						// {
						// 	html_question_tag += '<center><br><div id="div-eval-category-' + evaluationID[v] + '" style="font-size: 22px; font-weight: bold; font-style: none; color: green;">(' + evaluationDESC[v] + ')</div></center>';
						// 	for(v1=0; v1 < questionaire.length; v1++)
						// 	{
						// 			if (categoryID[v1] === evaluationID[v]){
										
						// 				html_question_tag += '<div id="div-eval-' + questionaireID[v1] + '">';
						// 							html_question_tag += '<p>' + 
						// 													questionaireRANKNO[v1] + 
						// 													'.   ' + 
						// 													' ' + questionaire[v1].replace('[||]',', ') + ' ' +
						// 													//'' + icat_id_cat1[2].replace('[||]',', ') + ' ' +
						// 													'<span>' + (questionaireISREQUIRED[v1].toString() == '0' ? '' : ' (Required)') + '</span>';
						// 							html_question_tag += '</p>';
													
						// 							html_question_choices = '';
													
						// 							//var ac = value.QUEST_CHOICE_ANS.split(',');
						// 							//var id = '';

						// 							console.log(choices);
						// 							console.log(choicesREMARKS);
						// 							console.log(choicesID);
						// 							for(iac=0; iac < choices.length; iac++){
						// 								//var ac_id_desc = ac[iac].split('=');
						// 									html_question_choices += (answerTYPE[v1].toString() === 'SINGLE' ?
						// 																'<div style="display: inline-flex;"><input type="radio" '
						// 																:
						// 																(answerTYPE[v1].toString() === 'MULTIPLE' ?
						// 																	'<div style="display: inline-flex;"><input type="checkbox" '
						// 																	:
						// 																	'<div style="display: inline-flex;"><textarea '));
						// 									html_question_choices += 'id="ans-' + questionaireID[v1].toString() + 
						// 															 '-' + evaluationID[v].toString() + 
						// 															 '-' + choicesID[iac].toString()  + 
						// 															 '-' + tbluniqueid + '" ';
						// 									html_question_choices += (answerTYPE[v1].toString() === 'SINGLE' ?
						// 																'name="ans-' + questionaireID[v1].toString() + '" value="' + choicesID[iac].toString() + '"/><label for="ans-'+ questionaireID[v1].toString() + 
						// 																'-' + evaluationID[v].toString() + 
						// 																'-' + choicesID[iac].toString()  + 
						// 																'-' + tbluniqueid +'">' + choices[iac].toString() + '   ' + choicesREMARKS[iac].toString() + '</label></div>'
						// 																:
						// 																(answerTYPE[v1].toString() === 'MULTIPLE' ?
						// 																	'name="ans-' + questionaireID[v1].toString() + '" value="' + choicesID[iac].toString() + '"/><label for="ans-'+ questionaireID[v1].toString() + 
						// 																	'-' + evaluationID[v].toString() + 
						// 																	'-' + choicesID[iac].toString()  + 
						// 																	'-' + tbluniqueid +'">' + choices[iac].toString() + '   ' + choicesREMARKS[iac].toString() + '</label></div>'
						// 																	:
						// 																	'name="txtarea-' + questionaireID[v1].toString() + '" rows="4" cols="80" ' + (questionaireISREQUIRED[v1].toString() == '0' ? '' : 'required') + '></textarea></div>'));
						// 								// html_question_choices += '</br>';
														
						// 								ctrlcreated.push((answerTYPE[v1].toString() === 'SINGLE' ?
						// 												'input[name="ans-' +  questionaireID[v1].toString() + '"]'
						// 												:
						// 												(answerTYPE[v1].toString() === 'MULTIPLE' ?
						// 													'input[name="ans-' +  questionaireID[v1].toString() + '"]'
						// 													:
						// 													'#txtarea-' +  questionaireID[v1].toString())));
						// 							ctrldiv.push('#div-eval-' + questionaireID[v1]);
						// 							if (questionaireISREQUIRED[v1].toString() == '1'){
						// 									ctrlrequired.push((answerTYPE[v1].toString() === 'SINGLE' ?
						// 												'input[name="ans-' +  questionaireID[v1].toString() + '"]'
						// 												:
						// 												(answerTYPE[v1].toString() === 'MULTIPLE' ?
						// 													'input[name="ans-' +  questionaireID[v1].toString() + '"]'
						// 													:
						// 													'#txtarea-' +  questionaireID[v1].toString())));
						// 													//alert(icat_id_cat1[1].toString());
						// 							}
						// 						}
						// 					html_question_tag = html_question_tag + html_question_choices;
						// 					html_question_tag += '</div>';
						// 					html_question_tag += '<hr>';
						// 					html_question_tag += '<br>';
						// 			}
						// 	}
						// }
						// html_question_tag += '<br><center><p style="font-size: 22px; font-weight: bold; font-style: none; color: green;">COMMENTS & SUGGESTIONS:</p><textarea id="txtarea-comments" name="txtarea-comments" maxlength="1000" style="width: 100%; height: 10rem; padding: .5rem;" placeholder="Write your comments here.."></textarea><center>';
						// html_question_tag += '<br><br><br><center><button type="button" style="padding-inline: 2rem; font-size: 16px; font-family: Roboto, sans-serif; font-weight: bold;" class="btn btn-block btn-primary" id="btn-submit-evaluation">Proceed</button><center>';
		
						// $('#main-content').html(html_question_tag);
						// $('#section-surv-main').css("cursor", "default");
						// // SubmitEvaluation();

						$('#btn-submit-evaluation').click(function() {
							// console.log(ctrldiv);
							for(x = 0; x< ctrlrequired.length; x++){
								if (ctrlrequired[x].includes('input')) {
									if (!$(ctrlrequired[x]).is(':checked')){
										var _crtldiv =  $(ctrlrequired[x]).closest('div').parent('div');
										_crtldiv.css('border', '2px solid red');
										_crtldiv.css('border-radius', '0.75rem');
										_crtldiv.css('padding', '0.25rem');
										$(ctrlrequired[x]).focus();
										return;
									} else {
										var _crtldiv =  $(ctrlrequired[x]).closest('div').parent('div');
										_crtldiv.css('border', '0px none transparent');
									}


								} else if(ctrlrequired[x].includes('textarea')) {
									if ($(ctrlrequired[x]).val().trim() === '') {
										var _crtldiv =  $(ctrlrequired[x]).closest('div').parent('div');
										_crtldiv.css('border', '2px solid red');
										_crtldiv.css('border-radius', '0.75rem');
										_crtldiv.css('padding', '0.25rem');
										$(ctrlrequired[x]).focus();
										return;
									} else {
										var _crtldiv =  $(ctrlrequired[x]).closest('div').parent('div');
										_crtldiv.css('border', '0px none transparent');
									}
								}

								
							}
							var _finalans_arr = [];
							var _finalans = '';
							var _evalinfo_id = 0;

							for(x = 0; x< ctrlcreated.length; x++){
								var iddiv = ctrldiv[x].split('-');
								//var evalinfo_id = $(ctrlcreated[x]).attr('id').split('-');

								if (ctrlcreated[x].includes('input')) {
									_text = ctrlcreated[x] + ':checked';
								} else if (ctrlcreated[x].includes('textarea')){
									_text = ctrlcreated[x];
								}

								_perquestion = iddiv[2].toString() + '=' + $(_text).val().toString().replace(/[^a-zA-Z0-9. ]/g, '');
								_evalinfo_id = evaluationinfoid[1];
								
								// console.log(_perquestion);
								if (!_finalans_arr.includes(_perquestion)) {
									_finalans_arr.push(_perquestion);
								}
							}

							var _comments =  $('#txtarea-comments').val().replace(/[^a-zA-Z0-9. ]/g, '');
							_finalans = _finalans_arr.join(',');
							// console.log(_evalinfo_id);
							// console.log(tblid);
							// console.log(tbluniqueid);
							// console.log(_comments);
							$.ajax({
									async: false,
									mode:'GET',
									url: '../../model/forms/survey/survey-controller.php',
									data:{
										mode : 'INSERT_EVALUATION',
										schlevalans_answer: _finalans,
										schlevalinfo_id : _evalinfo_id,
										schlevalinfo_tbl_id: tblid,
										schlevalinfo_tbl_unique_id: tbluniqueid,
										schlevalans_comments: _comments
									},
									beforeSend: function(){
										$('#section-surv-main').css("cursor", "progress");
									},
									success: function(result)
									{
										var _btnEval= evaltblrowid.find("button");
										_btnEval.remove();
										evaltblrowid.addClass('img');
										$('#btn-close-eval-content').click();
										ctrlcreated = [];
										ctrldiv = [];
										ctrlrequired  = [];
										alert('Submit Successful.');
										$('#div-message').html('Submit Successful.');
										$('#btn-close-survey-content').click();
										$('#section-surv-main').css("cursor", "default");
									},
									error: function(error){
										alert('Submit Failed, Please try to submit again.');
										$('#div-message').html('Submit Failed, Please try to submit again.');
									},
									complete: function(){
										$('#section-surv-main').css("cursor", "default");
									},
							});
						});
					} else {
						$('#main-content').html('<center><div style="font-size: 20px; font-weight: bold; font-style: italic; text-decoration: none;color: red;">NO ASSIGNED QUESTIONAIRE</div></center>');
						$('#section-surv-main').css("cursor", "default");
					}
				},
				complete: function(){
					$('#section-surv-main').css("cursor", "default");
				},
			});
		});
	}
	
	$('#btn-close-survey-content').on('click',function()
	{
		$('#main-content').html('');
		$('#hd-survey-content').html('');
		$('#div-survey-content').hide();
		$('#div-survey-header').show();
	});

	$('body').on('click', '#btn-close-list', function(){
		$('#div-list').show();
		$('#div-survey-header').hide();
		$('#main-survey').html('');
		$('#main-evaluation').html('');
		
	});
	
	function SubmitSurvey(){
	}
	
	function Initialized()
	{
		$('#div-process').html('loading');
		ViewListOfSurvey();
		$('#div-survey-content').hide();
	}
	
	Initialized();
});