$(document).ready(function()
{
    $('.main').click(function(){
		$('.list').removeClass('active');
	});
	$('.list').click(function(){
		$('.main').removeClass('active');
	});
	$("#user-home").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
    		FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/home-model.php');
		}
	});
	$("#user-grading-scale").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/manage/gradingscale/gradingscale-model.php');
		}
	});
	$("#user-class-list").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/view/classlist/classlist-model.php');
		}
	});
	$("#user-examination-permit").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/view/examinationpermit/examinationpermit-model.php');
		}
	});
	$("#user-enrollment-monitoring").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/enrollment/enrollment-monitoring-model.php');
		}
	});
	$("#user-submitted-grades").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/submittedgrades/submitted-grades-model.php');
		}
	});
	$("#user-profile").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/myaccount/profile-model.php');
		}
	});
	$("#user-change-password").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/myaccount/change-password-model.php');
		}
	});
	// usersubjectschedulegrades.on('click',function() {
	// 	FetchToSession($(this).text());
	// 	$("#masterpage-menu-label").html($(this).text());
	// 	$('#user-section').empty();
	// 	$('#user-section').load('../../model/forms/academic/subjectschedulegrades/subjectschedulegrades-model.php');
	// });
	$("#user-academic").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/academic/subjectschedulegrades/subjectschedulegrades-model.php');
		}
	});
	$("#user-grades").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/cog/grade-print-model.php');
		}
	});
	$("#user-survey").on('click',function() {
		if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
			FetchToSession($(this).text().trim());
			$("#masterpage-menu-label").html($(this).text().trim());
			$('#user-section').empty();
			$('#user-section').load('../../model/forms/survey/survey-model.php');
		}
	});
	$("#user-career-survey").on('click',function() {
		if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
			FetchToSession($(this).text().trim());
			$("#masterpage-menu-label").html($(this).text().trim());
			$('#user-section').empty();
			$('#user-section').load('../../model/forms/careersurvey/survey-model_old.php');
		}
	});
	$("#user-evaluation").on('click',function() {
		if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
			FetchToSession($(this).text().trim());
			$("#masterpage-menu-label").html($(this).text().trim());
			$('#user-section').empty();
			$('#user-section').load('../../model/forms/evaluation/evaluation-model.php');
		}
	});
	$("#user-analytics").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/analytics/analytics-model.php');
		}
	});
	$("#user-grade-history").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/grade-history/grade-history-model.php');
		}
	});
	$("#user-create-user").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/user/create-user-model.php');
		}
	});
	$("#user-survey-monitoring").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/surveymonitoring/surveymonitoring-model.php');
		}
	});
	$("#user-enrollment-list").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/view/enrollmentlist/enrollmentlist-model.php');
		}
	});
	$("#user-tadi").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/tadi/index.php');
		}
	});
	
	$("#user-tadi-dean").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/tadi/dean/index.php');
		}
	});
	
	$("#user-log-out").on('click',function() {
		$("#masterpage-menu-label").html($(this).text());
		$.ajax({
			type:'POST',
			cache: false,
			url: 'masterpage-logout-controller.php',
			success: function(data){
				window.location.replace("../../index.php");
			}
		});
	});
	
	$("#user-enrollment-master-list").on('click',function() {
	    if ($("#masterpage-menu-label").text().trim() != $(this).text().trim())
		{
		    FetchToSession($(this).text());
    		$("#masterpage-menu-label").html($(this).text());
    		$('#user-section').empty();
    		$('#user-section').load('../../model/forms/enrollment/master-list/master-list-model.php');
		}
	});
	function GetLastMenuToSession()
	{
			$.ajax({
				type:'POST',
				cache: false,
				url: 'masterpage-controller.php',
				data: { 
						action: 'MENU_NAME'
				},
				success: function(ret){
					if (ret == 'HOME'){
						$('#user-home').click();
					} else if (ret == 'GRADING SCALE'){
						$('#user-grading-scale').click();
					} else if (ret == 'CLASS LIST'){
						$('#user-class-list').click();
					} else if (ret == 'EXAMINATION PERMIT'){
						$('#user-examination-permit').click();
					} else if (ret == 'MONITORING'){
						$('#user-enrollment-monitoring').click();
					} else if (ret == 'SUBMITTED GRADES'){
						$('#user-submitted-grades').click();
					} else if (ret == 'PROFILE'){
						$('#user-profile').click();
					} else if (ret == 'CHANGE PASSWORD'){
						$('#user-change-password').click();
					// } else if (ret == 'SUBJECT/SCHEDULE/GRADES'){
					// 	usersubjectschedulegrades.click();
					} else if (ret == 'ACADEMIC'){
						$('#user-academic').click();
					} else if (ret == 'GRADES'){
						$('#user-grades').click();
					}else if (ret === 'SURVEY'){
						$('#user-survey').click();
					}else if (ret === 'CAREER INTEREST SURVEY'){
						$('#user-career-survey').click();
					}else if (ret === 'EVALUATION'){
						$('#user-evaluation').click();
					} else if (ret == 'ANALYTICS'){
						$('#user-analytics').click();
					} else if (ret == 'USERS'){
						$('#user-create-user').click();
					} else if (ret == 'SURVEY MONITORING'){
						$('#user-survey-monitoring').click();
					} else if (ret == 'GRADE HISTORY'){
						$('#user-grade-history').click();
					} else if (ret == 'ENROLLMENT LIST'){
						$('#user-grade-history').click();
					} else if (ret == 'MASTER LIST'){
						$('#user-enrollment-master-list').click();
					} else if (ret == 'TADI'){
						$('#user-tadi').click();
					} else if (ret == 'TADI - DEAN'){
						$('#user-tadi-dean').click();
					} else {
						//$('#user-home').click();
					}
				}
			});
	}
	
	function FetchToSession(_str)
	{
		$.ajax({
			type:'GET',
			url: 'masterpage-controller.php',
			data: { 
				action: 'MENU_NAME',
				info: _str
			},
			success: function(ret){
				if (ret == '1'){ 
					// Fetch Success
				} else {
					// 0: Fetch Failed
				}
			}
		});
	}
	function GetMasterPageDisplayContent()
	{
			$.ajax({
				type:'GET',
				cache: false,
				url: 'masterpage-image-controller.php',
				success: function(data){
					$('#user-picture').html(data);
					$('#user-home').click();
					//$('#user-type').html(data);
				}
			});
	}
	
	function GetApplicationRootDirectory()
	{
		$.get( '../../declaration.php', function(data) {
			global_app_root_directory = data;
		});
		return global_app_root_directory;
	}
	
	function InitializeMasterPage()
	{
	    // display_ct();
		GetMasterPageDisplayContent();
		GetLastMenuToSession();
	}
	InitializeMasterPage();
});

function display_ct(){
	var x = new Date();
	document.getElementById('input-hidden-div').innerHTML = x.getSeconds();
	//$('#input-hidden-div').html(x.getSeconds());
	display_c();
}
function display_c(){
	var refresh=1000; // Refresh rate in milli seconds
	mytime=setTimeout('display_ct()',refresh);
}