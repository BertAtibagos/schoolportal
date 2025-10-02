$(document).ready(function(){
	const titlelabel = $('#title-label');
	const divmessage = $('#div-message');
	const tbodyenrollment = $('#tbody-enrollment');
	const cboacadlvl = $('#cbo-acadlvl');
	const cboacadyr = $('#cbo-acadyr');
	const cboacadprd = $('#cbo-acadprd');
	const cboacadcrse = $('#cbo-acadcrse');
	const cboacadyrlvl = $('#cbo-acadyrlvl');
	const cboinstructor = $('#cbo-instructor');
	const cboacadsubject = $('#cbo-acadsubject');
	const tdttlofferedcrse = $('#tdttlofferedcrse');
	const tdttlenrollstud = $('#tdttlenrollstud');
	const tdttl1styr = $('#tdttl1styr');
	const tdttl2ndyr = $('#tdttl2ndyr');
	const tdttl3rdyr = $('#tdttl3rdyr');
	const tdttl4thyr = $('#tdttl4thyr');
	const tdttlofferedsubj = $('#tdttlofferedsubj');
	const tdttlinstructor = $('#tdttlinstructor');
	const thchk = $('#th-chk');
	const tablesummarytd = $('#table-summary td');
	const tablecategorytrhastd = $('#table-category tr:has(td)');
	const btnsearch = $('#btnsearch');
	
	function GetAcademicLevel(type)
	{
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											"<td colspan='6' " + 
											"style='font-size: 16px;" + 
											"font-family: Roboto, sans-serif;" + 
											"font-weight: normal;" + 
											"text-decoration: none;" + 
											"color: red;'>" +
											"No Record Found" +
											"</td>" +
											"</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboLevel = '';
					if(ret.length) {
						$.each(ret, function(key, value) {
							cboLevel += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboLevel += "<option value='0'>None</option>";
					}
					cboacadlvl.html(cboLevel);
					GetAcademicYear('ACADYEAR',cboacadlvl.val());
				}
			});
		}
		catch(e) {  //We can also throw from try block and catch it here
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicYear(type,lvlid){
		try { 
			$.ajax({
				type: 'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboYear = '';
					if(ret.length) {
						$.each(ret, function(key, value) {
							cboYear += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboYear += "<option value='0'>None</option>";
					}
					
					cboacadyr.html(cboYear);
					GetAcademicPeriod('ACADPERIOD',cboacadlvl.val(),cboacadyr.val());
				}
			});
		}
		catch(e) {
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicPeriod(type,lvlid,yrid){
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											"<td colspan='6' " + 
											"style='font-size: 16px;" + 
											"font-family: Roboto, sans-serif;" + 
											"font-weight: normal;" + 
											"text-decoration: none;" + 
											"color: red;'>" +
											"No Record Found" +
											"</td>" +
											"</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboPeriod = '';
					if(ret.length) {
						$.each(ret, function(key, value) {
							cboPeriod += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
						
					} else {
						cboPeriod += "<option value='0'>None</option>";
					}
					
					cboacadprd.html(cboPeriod);
					GetAcademicCourse('ACADCOURSE',cboacadlvl.val(),cboacadyr.val(),cboacadprd.val());
				}
			});
		}
		catch(e) {  //We can also throw from try block and catch it here
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicCourse(type,lvlid,yrid,prdid){
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid,
					periodid: prdid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboCourse = '';
					if(ret.length) {
						cboCourse += "<option value='0'>All</option>";
						$.each(ret, function(key, value) {
							cboCourse += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboCourse += "<option value='0'>None</option>";
					}
					
					cboacadcrse.html(cboCourse);
					GetAcademicYearLevel('ACADYEARLEVEL',cboacadlvl.val(),cboacadyr.val(),cboacadprd.val(),cboacadcrse.val());
				}
			});
		}
		catch(e) {  //We can also throw from try block and catch it here
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicYearLevel(type,lvlid,yrid,prdid,crseid){
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid,
					periodid: prdid,
					courseid: crseid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboYearLevel = '';
					if(ret.length) {
						cboYearLevel += "<option value='0'>All</option>";
						$.each(ret, function(key, value) {
							cboYearLevel += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboYearLevel += "<option value='0'>None</option>";
					}
					
					cboacadyrlvl.html(cboYearLevel);
					GetAcademicInstructor('INSTRUCTOR',cboacadlvl.val(),cboacadyr.val(),cboacadprd.val(),cboacadcrse.val(),cboacadyrlvl.val());
				}
			});
		}
		catch(e) {
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicInstructor(type,lvlid,yrid,prdid,crseid,yrlvlid){
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid,
					periodid: prdid,
					courseid: crseid,
					yearlevelid: yrlvlid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboInstructor = '';
					if(ret.length) {
						cboInstructor += "<option value='0'>All</option>";
						$.each(ret, function(key, value) {
							cboInstructor += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboInstructor += "<option value='0'>None</option>";
					}
					
					cboinstructor.html(cboInstructor);
					GetAcademicSubject('ACADSUBJECT',cboacadlvl.val(),cboacadyr.val(),cboacadprd.val(),cboacadcrse.val(),cboacadyrlvl.val(),cboinstructor.val());
				}
			});
		}
		catch(e) {  //We can also throw from try block and catch it here
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetAcademicSubject(type,lvlid,yrid,prdid,crseid,yrlvlid,uid){
		try { 
			$.ajax({
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid,
					periodid: prdid,
					courseid: crseid,
					yearlevelid: yrlvlid,
					userid: uid
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					var ret = JSON.parse(result);
					var cboSubject = '';
					if(ret.length) {
						cboSubject += "<option value='0'>All</option>";
						$.each(ret, function(key, value) {
							cboSubject += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
						});
					} else {
						cboSubject += "<option value='0'>None</option>";
					}
					
					cboacadsubject.html(cboSubject);
				}
			});
		}
		catch(e) {
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	function GetEnrolledStudentList(type,lvlid,yrid,prdid,crseid,yrlvlid,headid,offeredsubjid,categorytype){
		try { 
			$.ajax({
				async: false,
				type:'GET',
				url: '../../model/forms/enrollment/enrollment-monitoring-controller.php',
				data:{
					type : type,
					levelid : lvlid,
					yearid: yrid,
					periodid: prdid,
					courseid: crseid,
					yearlevelid: yrlvlid,
					headid: headid,
					offeredsubjid: offeredsubjid,
					categorytype: categorytype
				},
				beforeSend: function (status) {
					tbodyenrollment.html("<tr>" +
											   "<td colspan='6' " + 
													  "style='font-size: 16px;" + 
													  "font-family: Roboto, sans-serif;" + 
													  "font-weight: normal;" + 
													  "text-decoration: none;" + 
													  "color: red;'>" +
													"No Record Found" +
											   "</td>" +
											   "</tr>");
				},
				success: function(result){
					if (JSON.parse(result))
					{
						var ret = JSON.parse(result);
						let rowno=1;
						var studlist = '';
						var ttl1styr = 0;
						var ttl2ndyr = 0;
						var ttl3rdyr = 0;
						var ttl4thyr = 0;
						var tdttlenrollstudcnt = 0;
						if(ret.length) 
						{
							if (categorytype == 1)
							{
								$.each(ret, function(key, value) {
									studlist += "<tr>" +
													"<td>" + rowno++ + "</td>" +
													"<td>" + value.STUD_NAME + "</td>" +
													"<td>" + value.GENDER + "</td>" +
													"<td>" + value.CRSE_SEC + "</td>" +
													"<td>" + value.YR_LVL_NAME + "</td>" +
													"<td>" + value.REG_STATUS + "</td>" +
												"</tr>";
									if (value.YR_LVL_NAME.indexOf('1ST') != -1){
										ttl1styr++;
									} else if (value.YR_LVL_NAME.indexOf('2ND') != -1){
										ttl2ndyr++;
									} else if (value.YR_LVL_NAME.indexOf('3RD') != -1){
										ttl3rdyr++;
									} else if (value.YR_LVL_NAME.indexOf('4TH') != -1){
										ttl4thyr++;
									}
									var f_arr = '';
									var resultarr = result.substring(2, (result.length- 2));
									var resultarr = resultarr.substring(0, (resultarr.length - 2));
									var resultarr = resultarr.split('},{');
									for(i=0; i < resultarr.length; i++){
										var r_arr = resultarr[i].replace('"','');
										var i_arr = r_arr.split(',');
										var i_arr1 = i_arr[3].split(':');
										var i_arr2 = jQuery.trim(i_arr1[1]);
										f_arr = f_arr.replace(i_arr2,'');
										f_arr = f_arr.concat(i_arr2);
										//f_arr = $.uniqueSort(f_arr)
									}
									//alert($.uniqueSort(f_arr).length);
									f_arr = f_arr.replaceAll('""',',');
									f_arr = f_arr.replaceAll('"','');
									var arr = f_arr.split(',');
									tdttlofferedcrse.html(arr.length);
								});
							} else {
								$.each(ret, function(key, value) 
								{
									tdttlenrollstudcnt = value.TTL_STUDENT;
									var ttlstudarr;
									if (value.TTL_STUDENT_PER_YEAR_LEVEL != null)
									{
										ttlstudarr = value.TTL_STUDENT_PER_YEAR_LEVEL.split(',');
										ttl1styr = ttlstudarr[0].toString();
										ttl2ndyr = ttlstudarr[1].toString();
										ttl3rdyr = ttlstudarr[2].toString();
										ttl4thyr = ttlstudarr[3].toString();
									} else {
										ttl1styr = 0;
										ttl2ndyr = 0;
										ttl3rdyr = 0;
										ttl4thyr = 0;
									}
								});
							}
						} else {
							studlist = "<tr>" +
												   "<td colspan='6' " + 
														  "style='font-size: 16px;" + 
														  "font-family: Roboto, sans-serif;" + 
														  "font-weight: normal;" + 
														  "text-decoration: none;" + 
														  "color: red;'>" +
														"No Record Found" +
												   "</td>" +
												   "</tr>";
							
						}
						tbodyenrollment.html(studlist);
						tdttlenrollstud.html(tdttlenrollstudcnt);
						tdttl1styr.html(ttl1styr);
						tdttl2ndyr.html(ttl2ndyr);
						tdttl3rdyr.html(ttl3rdyr);
						tdttl4thyr.html(ttl4thyr);
						tdttlofferedcrse.html($('#cbo-acadcrse option').length - 1);
						tdttlofferedsubj.html($('#cbo-acadsubject option').length - 1);
						tdttlinstructor.html($('#cbo-instructor option').length - 1);
						titlelabel.html('Enrollment Summary ( ' + $('#cbo-acadyr option:selected').text() + ' ' + $('#cbo-acadprd option:selected').text() + ' )');
					}
				}
			});
		}
		catch(e) {
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	}
	cboacadlvl.on('change',function(){
		GetAcademicYear('ACADYEAR',$(this).val());
	});
	cboacadyr.on('change',function(){
		GetAcademicPeriod('ACADPERIOD',cboacadlvl.val(),$(this).val());
	});
	cboacadprd.on('change',function(){
		GetAcademicCourse('ACADCOURSE',cboacadlvl.val(),cboacadyr.val(),
						$(this).val());
	});
	cboacadcrse.on('change',function(){
		GetAcademicYearLevel('ACADYEARLEVEL',cboacadlvl.val(),cboacadyr.val(),
						cboacadprd.val(),$(this).val());
	});
	cboacadyrlvl.on('change',function(){
		GetAcademicInstructor('INSTRUCTOR',cboacadlvl.val(),cboacadyr.val(),
						cboacadprd.val(),cboacadcrse.val(),
						$(this).val());
	});
	cboinstructor.on('change',function(){
		GetAcademicSubject('ACADSUBJECT',cboacadlvl.val(),cboacadyr.val(),
						cboacadprd.val(),cboacadcrse.val(),cboacadyrlvl.val(),$(this).val());
	});
	cboacadsubject.on('change',function(){
		//GetEnrolledStudentList('TOTAL_ENROLLED_STUDENT',$('#cbo-acadlvl').val(),$('#cbo-acadyr').val(),$('#cbo-acadprd').val(),$('#cbo-acadcrse').val(),$('#cbo-acadyrlvl').val(),$('#cbo-instructor').val(),$('#cbo-acadsubject',2).val());
	});
	btnsearch.on('click',function(){
		GetEnrolledStudentList('TOTAL_ENROLLED_STUDENT',cboacadlvl.val(),cboacadyr.val(),
						cboacadprd.val(),cboacadcrse.val(),cboacadyrlvl.val(),cboinstructor.val(),cboacadsubject.val(),2);
	});
	tablesummarytd.on('click',function() {
		var id = $(this).attr("id");
	});
	thchk.on('click',function() {
        var isChecked = $(this).prop("checked");
        tablecategorytrhastd.find("input[type='checkbox']").prop('checked', isChecked);
    });
	function Initialize() {
		GetAcademicLevel('ACADLEVEL');
	}
	Initialize();
	
});