$(document).ready(function()
{
	const btnyes = $('.yes');
	const btnno = $('.no');
	const btnclose = $('.close');
	const btnok = $('.ok');
	
	btnok.on('click',function(e) {
		$('#evaluation-master-modal').modal('hide');
	});
	btnclose.on('click',function(e) {
		$('#evaluation-master-modal').modal('hide');
	});
	btnyes.on('click',function(e) {
		$('#evaluation-master-modal').modal('hide');
	});
	btnno.on('click',function(e) {
		$('#evaluation-master-modal').modal('hide');
	});
	// function GetDepartmentSignatories(schldeptid){
		// $.ajax({
			// type: 'GET',
			// url: '../../model/forms/view/classlist/classlist-controller.php',
			// data:{
				// type : 'GET_DEPARTMENT_SIGNATORIES',
				// action: 'FETCH'
				// schldeptid: schldeptid
			// },
			// beforeSend: function (status) {
				// $(document.body).css({'cursor':'wait'});
				// $('#div-message').html('');
			// },
			// success: function(result){
				// var data = result;
				// if (data.length) {
					// $.each(data, function(key, value.APPROVER_ID) {
						// $.session.get('APPROVERID',value.APPROVER_ID);
					// });
				// } else {
					// $.session.get('APPROVERID','');
				// }
			// }
		// });
	// }
	// $('.close').click(function() {
		// $('#master-modal').modal('hide');
	// });
	// $('.cancel').click(function() {
		// $('#master-modal').modal('hide');
	// });
	// $('.save').click(function() {
		
		// var schlacadgradscaleid = parseInt(global_GSCALEID);
		// var schlstudid = parseInt(global_CLSTUDID);
		// var schlenrollsubjoffid = parseInt(global_SUBJOFFID);
		// var schlstudacadrecdetinputvalueid = global_TXTINPUTVALUE;
		// var schlstudacadrecid = parseInt(global_STUDACADRECID);
		// var schlstudacadrecdetid = parseInt(global_STUDACADRECDETID);
		// var schlenrollasssmsid = parseInt(global_STUDASSID);
		// global_RESULTTYPE = $('#cbo-final-average-status option:selected').text();
		// //alert($('#cbo-final-average-status option:selected').text());
		// var schlstudacadrecdetresulttype = $('#cbo-final-average-status option:selected').text();//$.session.get('RESULTTYPE');
		// var schlsignid = parseInt(global_SIGNID);
		// var schlsignuserid = parseInt(global_SIGNUSERID);
		// var txtinputvaluearr = schlstudacadrecdetinputvalueid.split(',');
		// var schlstudacadrecdetrecords = '';
		// for(i=0; i < txtinputvaluearr.length; i++){
			// var gsdetid = txtinputvaluearr[i].split('-');
			// schlstudacadrecdetrecords += gsdetid[3] + ':' + $(txtinputvaluearr[i]).val() + ',';
		// }
		// schlstudacadrecdetrecords = schlstudacadrecdetrecords.substring(0, (schlstudacadrecdetrecords.length - 1));
		// $.ajax({
			// type: 'GET',
			// url: '../../model/forms/view/classlist/classlist-controller.php',
			// data:{
				// type : 'MANAGE_STUDENT_GRADES',
				// action: 'MANAGE',
				// mode: 'MANAGE',
				// schlstudid: schlstudid,
				// schlacadgradscaleid: schlacadgradscaleid,
				// schlenrollsubjoffid: schlenrollsubjoffid,
				// schlenrollasssmsid: schlenrollasssmsid,
				// schlstudacadrecid: schlstudacadrecid,
				// schlstudacadrecdetid: schlstudacadrecdetid,
				// schlstudacadrecdetresulttype: schlstudacadrecdetresulttype,
				// schlsignid: schlsignid,
				// schlsignuserid: schlsignuserid,
				// schlstudacadrecdetrecords: schlstudacadrecdetrecords,
				// reqstatus: 0
			// },
			// beforeSend: function (status) {
				// $(document.body).css({'cursor':'wait'});
				// $('#div-message').html('');
			// },
			// success: function(result){
				// alert('');
				// var ret = result;
				// var colstat = global_TDCOLSTATUS;
				// var tdproc = global_TDPROCESS;
				// var tdbtnviewstudent = global_BTSTUDENTID;
				// $('#' + global_CURRENTSTUDACADAVG).html($('#b-final-average').html());
				// if (parseFloat(global_GSCALEPASSSCOREID) > 0) {
					// if (parseFloat($('#b-final-average').html()) >= parseFloat(global_GSCALEPASSSCOREID)){
						// //$('#' + $.session.get('CURRENTSTUDACADAVGSTATUS')).html($('#p-final-average-status').html());
						// $('#' + global_CURRENTSTUDACADAVGSTATUS).html($('#cbo-final-average-status option:selected').text());
						// //alert($('#b-final-average').html() + ' : ' + $.session.get('GSCALEPASSSCOREID').toString());
					// } else {
						// $('#' + global_CURRENTSTUDACADAVGSTATUS).html($('#cbo-final-average-status option:selected').text());
						// //alert($('#b-final-average').html() + ' : ' + $.session.get('GSCALEPASSSCOREID').toString() + ' | ' + $('#cbo-final-average-status option:selected').text());
					// }
				// } else {
					// $('#' + global_CURRENTSTUDACADAVGSTATUS).html($('#p-final-average-status').html());
				// }
				
				// if (schlstudacadrecdetid.length <= 0 || parseInt(schlstudacadrecdetid) <= 0){
					// var ttlencoded = (parseInt(global_NOOFSTUDENTENCODED) + 1);
					// var ttlnotencoded = (parseInt(global_TTLNOOFENROLLEDSTUDENT) - (parseInt(global_NOOFSTUDENTENCODED) + 1));
					// $('#' + global_INPUTNOOFSTUDENTENCODED).prop('name',ttlencoded);
					// global_NOOFSTUDENTENCODED = ttlencoded;
					
					// if (parseFloat(ttlnotencoded) > 0){
						// $('#' + global_PNOTYETENCODED).html(ttlnotencoded + ' STUDENT NOT YET ENCODED');
					// } else {
						// var tdprocess = '';
						// var elementidarr = global_BTSTUDENTID.split('-');
						// if (parseInt(elementidarr[2]) == 0) {
							// _ret = '1';
						// } else if (parseInt(elementidarr[2]) == 2) {
							// _ret = '0';
						// } else if (parseInt(elementidarr[2]) == 5) {
							// _ret = '6';
						// } else if (parseInt(elementidarr[2]) == 7) {
							// _ret = '5';
						// } else {
							// _ret = '1';
						// }
						// global_STUDACADRECREQSTATUS = _ret;
						// var elementid = elementidarr[0] + '-' + elementidarr[1] + '-' + _ret + '-' + elementidarr[3];
						// if (global_GSCALEID > 0){
							// if (global_GSCALEPASSSCOREID.length <= 0 || global_GSCALEPASSSCOREID == '' || global_GSCALEPASSSCOREID == '0' || global_GSCALEPASSSCOREID == 0){
									// tdprocess = "<div style='font-size: 11px;" + 
														   // "font-family: Roboto, sans-serif;" + 
														   // "font-weight: normal;" + 
														   // "text-decoration: none;" + 
														   // "color: red;' " +
														   // "id='" + elementid + "' " +
														   // "name='" + global_BTSTUDENTNAME + "'>" +
														   // "PASSING SCORE NOT SET" +
														// "</div>";
							// } else {
								// if (parseInt(global_STUDACADRECREQSTATUS) == 0) {
									// tdprocess = "<button " +
															// "style='font-size: 10px;" +
															// "font-family: Roboto, sans-serif;" +
															// "font-weight: normal;" +
															// "text-decoration: none;" + 
															// "color: white;' " +
															// "id='" + elementid + "' class='btn btn-danger btnsubmit' " +
															// "name='" + global_BTSTUDENTNAME + "'>Submit" +																
														// "</button>";
									// $('#' + colstat).html('FOR SUBMISSION');
									// //colstat.html('FOR SUBMISSION');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) == 1) {
									// tdprocess = "<div style='font-size: 11px;" + 
													   // "font-family: Roboto, sans-serif;" + 
													   // "font-weight: normal;" + 
													   // "text-decoration: none;" + 
													   // "vertical-align: middle;" +
													   // "color: red;' " +
													   // "id='" + elementid + "' " +
													   // "name='" + global_BTSTUDENTNAME + "'>" +
													// "Submitted" +
												// "</div>";
									// $('#' + colstat).html('FOR APPROVAL');
									// //colstat.html('FOR APPROVAL');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) == 2) {
									// tdprocess = "<button style='font-size: 10px;" +
															// "font-family: Roboto, sans-serif;" +
															// "font-weight: normal;" +
															// "text-decoration: none;" + 
															// "color: white;' " +
															// "id='" + elementid + "' class='btn btn-danger btnsubmit' " +
															// "name='" + global_BTSTUDENTNAME + "'>Re-Submit" +																
														// "</button>";
									// $('#' + colstat).html('DENIED');
									// //colstat.html('DENIED');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) >= 3 && parseInt(global_STUDACADRECREQSTATUS) <= 4) {
									// tdprocess = "<div style='font-size: 11px;" + 
													   // "font-family: Roboto, sans-serif;" + 
													   // "font-weight: normal;" + 
													   // "text-decoration: none;" + 
													   // "color: red;' " +
													   // "id='" + elementid + "' " +
													   // "name='" + global_BTSTUDENTNAME + "'>" +
													// "On Process" +
												// "</div>";
									// $('#' + colstat).html('ON PROGRESS');
									// //colstat.html('ON PROGRESS');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) == 5) {
									// tdprocess = "<button " +
															// "style='font-size: 10px;" +
															// "font-family: Roboto, sans-serif;" +
															// "font-weight: normal;" +
															// "text-decoration: none;" + 
															// "color: white;' " +
															// "id='" + elementid + "' class='btn btn-danger btnsubmit' " +
															// "name='" + global_BTSTUDENTNAME + "'>Request(Edit Grades)" +																
														// "</button>";
									// $('#' + colstat).html('APPROVED');
									// //colstat.html('APPROVED');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) == 6) {
									// tdprocess = "<div style='font-size: 11px;" + 
													   // "font-family: Roboto, sans-serif;" + 
													   // "font-weight: normal;" + 
													   // "text-decoration: none;" + 
													   // "vertical-align: middle;" +
													   // "color: red;' " +
													   // "id='" + elementid + "' " +
													   // "name='" + global_BTSTUDENTNAME + "'>" +
													// "Request(Edit Grades) Submitted" +
												// "</div>";
												// //alert(tdprocess);
									// $('#' + colstat).html('FOR APPROVAL(EDIT GRADES)');
									// //colstat.html('FOR APPROVAL(EDIT GRADES)');
								// } else if (parseInt(global_STUDACADRECREQSTATUS) == 7) {
									// tdprocess = "<button " +
														// "style='font-size: 10px;" +
														// "font-family: Roboto, sans-serif;" +
														// "font-weight: normal;" +
														// "text-decoration: none;" + 
														// "color: white;' " +	
														// "id='" + elementid + "' class='btn btn-danger btnsubmit' " +
														// "name='" + global_BTSTUDENTNAME + "'>Re-Submit Request(Edit Grades)" +																
													// "</button>";
									// $('#' + colstat).html('REQUEST DENIED(EDIT GRADES)');
									// //colstat.html('REQUEST DENIED(EDIT GRADES)');
								// } else {
									// tdprocess = "<button " +
														// "style='font-size: 10px;" +
														// "font-family: Roboto, sans-serif;" +
														// "font-weight: normal;" +
														// "text-decoration: none;" + 
														// "color: white;' " +	
														// "id='" + elementid +  "' class='btn btn-success btnsubmit' " +
														// "name='" + global_BTSTUDENTNAME + "'>Submit" +																
													// "</button>";
									// $('#' + colstat).html('FOR SUBMISSION');
									// //colstat.html('FOR SUBMISSION');
								// }
							// }
						// } else {
							// tdprocess = "<div style='font-size: 11px;" + 
												// "font-family: Roboto, sans-serif;" + 
												// "font-weight: normal;" + 
												// "text-decoration: none;" + 
												// "color: red;' " +
												// "id='" + elementid + "' " +
												// "name='" + global_BTSTUDENTNAME + "'>" +
												// "NO ASSIGNED (GS)" +
											// "</div>";
						// }
										
						// $('#' + tdproc).html(tdprocess);
						// $('.btnviewstudent').click();
					// }
				// } 
				
				// //$("#div-offered-subject").load(location.href + " #div-offered-subject");
				
				// $('#b-final-average').html('0%');
				// $('#div-message').html('');
				// $('#master-modal').modal('hide');
				// $(document.body).css({ 'cursor': 'auto' });
			// },
			// complete: function(status) {
				// $(document.body).css({ 'cursor': 'auto' });
			// },
			// error:function(status){
				// $('#div-message').html("<p style='color: red; font-size: 12px; font-style: italic; font-weight: bold;'>Save Failed!, Please try saving again.</p>");
				// $(document.body).css({ 'cursor': 'auto' });
			// }
		// });
	// });
});