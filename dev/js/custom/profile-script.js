$(document).ready(function(){
	var type = $('#usertype').val();

	if($(window).width() < $(window).height()){
		$(".4").text("Academic");
		$(".1").text("Information");
		$(".2").text("Contact");
		$(".5").text("Family");
	}else{
		$(".4").text("Academic Information");
		$(".1").text("Other Information");
		$(".2").text("Contact Information");
		$(".5").text("Family Information");
	}
	
	$(window).resize(function() {
		if($(window).width() < $(window).height()){
			$(".4").text("Academic");
			$(".1").text("Information");
			$(".2").text("Contact");
			$(".5").text("Family");
		}else{
			$(".4").text("Academic Information");
			$(".1").text("Other Information");
			$(".2").text("Contact Information");
			$(".5").text("Family Information");
		}
	});

	$.ajax({
		type: 'POST',
		async: false,
		url: '../../model/forms/myaccount/profile-controller.php',
		data: {
			type : type
		},
		success: function(result){
			$.ajax({
				type:'GET',
				url: '../../model/forms/myaccount/profile-image-controller.php',
				success: function(data){
					$('#profile-picture').html(data);
				},
			});
			var ret = JSON.parse(result);
			if(ret.length){
				if(type == 'STUDENT'){
					$.each(ret, function(key, value) {
						$('#fullname').text(value.NAME);
						$('#gradeSec').text(value.SEC + "("+ value.YRLVL +")");
						$('#gender').text(value.GENDER);
						$('#age').text(value.AGE + " YEARS OLD");
						$('#birthday').text(value.BDAY);
						$('#birthplc').text(value.BPLACE);
						$('#religion').text(value.RELIGION);
						$('#civilStat').text(value.CIVIL_STAT);
						$('#nationality').text(value.NATION);
						$('#email').text(value.EMAIL);
						$('#mobileNo').text('0'+parseInt(value.MOBNO));
						$('#telNo').text(value.TELNO);
						$('#presAdd').text(value.PRES_ADD +", "+ value.PRES_BRGY_NAME +", "+ value.PRES_MUN_NAME +", "+ value.PRES_PROV_NAME +", "+ value.PRES_ZIP);
						$('#permAdd').text(value.PERM_ADD +", "+ value.PERM_BRGY_NAME +", "+ value.PERM_MUN_NAME +", "+ value.PERM_PROV_NAME +", "+ value.PERM_ZIP);
						$('#studNo').text(value.IDNO);
						$('#lrn').text(parseInt(value.LRN));
						$('#father').text(value.FATHER_NAME);
						$('#mother').text(value.MOTHER_NAME);
						$('#guardian').text(value.GUARDIAN_NAME);
						$('#father-contact').text('0'+parseInt(value.FATHER_CONTACT));
						$('#father-email').text(value.FATHER_EMAIL);
						$('#mother-contact').text('0'+parseInt(value.MOTHER_CONTACT));
						$('#mother-email').text(value.MOTHER_EMAIL);
						$('#guardian-contact').text('0'+parseInt(value.GUARDIAN_CONTACT));
						$('#guardian-email').text(value.GUARDIAN_EMAIL);
						$('#guardian-relationship').text(value.GUARDIAN_REL);

					});
				} else if(type == 'EMPLOYEE'){
					$.each(ret, function(key, value) {
						$('#fullname').text(value.NAME);
						$('#gradeSec').text(value.JOBPOS_NAME);
						$('#gender').text(value.GENDER);
						$('#age').text(value.AGE + " YEARS OLD");
						$('#birthday').text(value.BDAY);
						$('#birthplc').text(value.BPLACE);
						$('#religion').text(value.RELIGION);
						$('#civilStat').text(value.CIVIL_STAT);
						$('#nationality').text(value.NATION);
						$('#email').text(value.EMAIL);
						$('#mobileNo').text(value.MOBNO);
						$('#telNo').text(value.TELNO);
						$('#presAdd').text(value.PRES_ADD);
						$('#permAdd').text(value.PERM_ADD);
						$('#studNo').text(value.EMP_ID);
						$('#lrn').text(value.DEPT_NAME);
						
						$(".user1").text("Employee ID:");
						$(".user2").text("Department Name:");
						$('.5').hide();

					});
				} else {
					alert('ERROR! Pls contact ICT DEPARTMENT!');
				}
			} else {

			}
		}
	});
	
});