$(document).ready(function(){
    $('#pr_acadname_text').keydown(function(event){
        if(event.keyCode == 13) {
        event.preventDefault();
        $("#btnSearchName").click();
        return false;
        }
    });

    $("#div_dropdown_grades").hide();
    $("#div_grades").hide();
    $('#btnPrintGrade').hide();

    $('#pr_acadname_text').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('body').on('click', '#btnBack', function(){
        $("#div_dropdown_grades").hide();
        $("#div_search_bar").show();
        $("#table-student").show();
        $('#pr_acadname_text').attr('readonly',false);
        $('#pr_acadname').attr('disabled',false);
        $('#btnSearchName').attr('disabled',false);
        $('#pr_acadlevel option').remove();
        $('#pr_acadyear option').remove();
        $('#pr_acadperiod option').remove();
        $('#pr_acadcourse option').remove();
        $('#thead-grades tr').remove();
        $('#tbody-grades tr').remove();
        $('#tbody-unit tr').remove();
        $("#div_grades").hide();
        $('#btnPrintGrade').hide();
    });

    $('#pr_acadlevel').change(function(){
        $(document.body).css({'cursor' : 'wait'});
        $("button").css({'cursor' : 'wait'});
        $("select").css({'cursor' : 'wait'});
        $('button').attr('disabled',true);
        $("#pr_acadyear option").remove();
        $("#pr_acadperiod option").remove();
        $("#pr_acadcourse option").remove();
        
        $('#tbody-grades tr').remove();
        $('#tbody-unit tr').remove();
        $('#thead-grades tr').remove();
        $('#btnPrintGrade').hide();

        var stud_id = $('#studid').val();
        var lvlid = $('#pr_acadlevel').val();

        $.ajax({
            type:'GET',
            url: '../../model/forms/cog/grade-print-controller.php',
            data:{
                type : 'ACADYEAR',
                levelid: lvlid,
                stud_id : stud_id
            },
            success: function(result){

                MyDropdown(result, "#pr_acadyear");

                var yrid = $('#pr_acadyear').val();

                $.ajax({
                    type:'GET',
                    url: '../../model/forms/cog/grade-print-controller.php',
                    data:{
                        type : 'ACADPERIOD',
                        levelid: lvlid,
                        yearid : yrid,
                        stud_id : stud_id
                    },
                    success: function(result){
                        MyDropdown(result, "#pr_acadperiod");
                        var prdid = $('#pr_acadperiod').val();

                        $.ajax({
                            type:'GET',
                            url: '../../model/forms/cog/grade-print-controller.php',
                            data:{
                                type : 'ACADCOURSE',
                                levelid: lvlid,
                                yearid : yrid,
                                periodid : prdid,
                                stud_id : stud_id
                            },
                            success: function(result){
                                $(document.body).css({'cursor' : 'default'});
                                $("button").css({'cursor' : 'default'});
                                $("select").css({'cursor' : 'default'});
                                $('button').attr('disabled',false);
                                $('#pr_acadname_text').attr('readonly',false);
                                $('#pr_acadname').attr('disabled',false);

                                MyDropdown(result, "#pr_acadcourse");

                            },
                            error:function(status){
                                $('#errormessage').html('Error!');
                            }
                        });
                    },
                    error:function(status){
                        $('#errormessage').html('Error!');
                    }
                });
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    $('#pr_acadyear').change(function(){
        $(document.body).css({'cursor' : 'wait'});
        $("button").css({'cursor' : 'wait'});
        $("select").css({'cursor' : 'wait'});
        $('button').attr('disabled',true);
        $("#pr_acadperiod option").remove();
        $("#pr_acadcourse option").remove();
        
        $('#tbody-grades tr').remove();
        $('#tbody-unit tr').remove();
        $('#thead-grades tr').remove();
        $('#btnPrintGrade').hide();
        
        var lvlid = $('#pr_acadlevel').val();
        var stud_id = $('#studid').val();
        var yrid = $('#pr_acadyear').val();

        $.ajax({
            type:'GET',
            url: '../../model/forms/cog/grade-print-controller.php',
            data:{
                type : 'ACADPERIOD',
                levelid: lvlid,
                yearid : yrid,
                stud_id : stud_id
            },
            success: function(result){
                MyDropdown(result, "#pr_acadperiod");
                var prdid = $('#pr_acadperiod').val();

                $.ajax({
                    type:'GET',
                    url: '../../model/forms/cog/grade-print-controller.php',
                    data:{
                        type : 'ACADCOURSE',
                        levelid: lvlid,
                        yearid : yrid,
                        periodid : prdid,
                        stud_id : stud_id
                    },
                    success: function(result){
                        $(document.body).css({'cursor' : 'default'});
                        $("button").css({'cursor' : 'default'});
                        $("select").css({'cursor' : 'default'});
                        $('button').attr('disabled',false);
                        $('#pr_acadname_text').attr('readonly',false);
                        $('#pr_acadname').attr('disabled',false);

                        MyDropdown(result, "#pr_acadcourse");

                    },
                    error:function(status){
                        $('#errormessage').html('Error!');
                    }
                });
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    $('#pr_acadperiod').change(function(){
        $(document.body).css({'cursor' : 'wait'});
        $("button").css({'cursor' : 'wait'});
        $("select").css({'cursor' : 'wait'});
        $('button').attr('disabled',true);
        $("#pr_acadcourse option").remove();
        
        $('#tbody-grades tr').remove();
        $('#tbody-unit tr').remove();
        $('#thead-grades tr').remove();
        $('#btnPrintGrade').hide();
        
        var lvlid = $('#pr_acadlevel').val();
        var yrid = $('#pr_acadyear').val();
        var stud_id = $('#studid').val();
        var prdid = $('#pr_acadperiod').val();

        $.ajax({
            type:'GET',
            url: '../../model/forms/cog/grade-print-controller.php',
            data:{
                type : 'ACADCOURSE',
                levelid: lvlid,
                yearid : yrid,
                periodid : prdid,
                stud_id : stud_id
            },
            success: function(result){
                $(document.body).css({'cursor' : 'default'});
                $("button").css({'cursor' : 'default'});
                $("select").css({'cursor' : 'default'});
                $('button').attr('disabled',false);
                MyDropdown(result, "#pr_acadcourse");

            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    $('#pr_acadcourse').change(function(){
        $('#tbody-grades tr').remove();
        $('#tbody-unit tr').remove();
        $('#thead-grades tr').remove();
        $('#btnPrintGrade').hide();
    });

    $("#btnSearchName").click(function(){
        $("#table-student").hide();
        $(document.body).css({'cursor' : 'wait'});
        $("#btnSearchName").css({'cursor' : 'wait'});
        $(".pr_acadname").css({'cursor' : 'wait'});
        $('button').attr('disabled',true);

	    $('#pr_acadname_text').attr('readonly',true);
	    $('#pr_acadname').attr('disabled',true);

	    var name_text = $('#pr_acadname_text').val();
	    var name_type = $('#pr_acadname').val();
        var lineNo = 1;

        $.ajax({
            type:'GET',
            url: '../../model/forms/cog/grade-print-controller.php',
            data:{
                type : 'STUDENT_LIST',
                name_text : name_text,
                name_type : name_type
            },
            success: function(result){
                var rsstudJSON = JSON.parse(result);
                var tblstudList = '';
                if(rsstudJSON.length) {
                    $.each(rsstudJSON, function(key, value){
                        tblstudList +=
                            "<tr id='"+ value.STUD_ID +"'>" +
                                "<td> "+ lineNo++ +" </td>" + 
                                "<td style='text-align:left;'> "+ value.STUD_NO +" </td>" + 
                                "<td style='text-align:left;' id='name"+ value.STUD_ID +"'> "+ value.FULL_NAME +"</td>" + 
                                "<td> <button id='btnGrade' name='btnGrade' class='btn btn-success btnGrade' style='font-size:10px;color: white;'> Grades </button> </td>" + 
                            "</tr>";
                    });
                } else {
                    tblstudList +="<tr>" + 
                                "<td style='text-align:CENTER;' colspan='4' > NO RESULT FOUND </td>" + 
                            "</tr>";
                }

                $('#student-no-result').remove();
                $('#tbody-student').html(tblstudList);
                $("#table-student").show();

                $(document.body).css({'cursor' : 'default'});
                $("#btnSearchName").css({'cursor' : 'default'});
                $(".pr_acadname").css({'cursor' : 'default'});
                $('#pr_acadname_text').attr('readonly',false);
                $('#pr_acadname').attr('disabled',false);
                $('button').attr('disabled',false);
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });

        $('body').on('click', '.btnGrade', function(){
            $(document.body).css({'cursor' : 'wait'});
            $("button").css({'cursor' : 'wait'});
            $("select").css({'cursor' : 'wait'});
            $('button').attr('disabled',true);
            $('#pr_acadname_text').attr('readonly',true);
            $('#pr_acadname').attr('disabled',true);

            var stud_id = $(this).parents('tr').attr("id");
            nameid = '#name'+stud_id;
            var stud_name = $(nameid).text();

            $('#student-name-p').text(stud_name);
            $('#studid').val(stud_id);
    
            $.ajax({
                type:'GET',
                url: '../../model/forms/cog/grade-print-controller.php',
                data:{
                    type : 'ACADLEVEL',
                    stud_id : stud_id
                },
                success: function(result){
                    $("#div_search_bar").hide();
                    $("#div_dropdown_grades").show();
                    $("#table-student").hide();

                    MyDropdown(result, "#pr_acadlevel");

                    var lvlid = $('#pr_acadlevel').val();

                    $.ajax({
                        type:'GET',
                        url: '../../model/forms/cog/grade-print-controller.php',
                        data:{
                            type : 'ACADYEAR',
                            levelid: lvlid,
                            stud_id : stud_id
                        },
                        success: function(result){
        
                            MyDropdown(result, "#pr_acadyear");
        
                            var yrid = $('#pr_acadyear').val();
        
                            $.ajax({
                                type:'GET',
                                url: '../../model/forms/cog/grade-print-controller.php',
                                data:{
                                    type : 'ACADPERIOD',
                                    levelid: lvlid,
                                    yearid : yrid,
                                    stud_id : stud_id
                                },
                                success: function(result){
                                    MyDropdown(result, "#pr_acadperiod");
                                    var prdid = $('#pr_acadperiod').val();
        
                                    $.ajax({
                                        type:'GET',
                                        url: '../../model/forms/cog/grade-print-controller.php',
                                        data:{
                                            type : 'ACADCOURSE',
                                            levelid: lvlid,
                                            yearid : yrid,
                                            periodid : prdid,
                                            stud_id : stud_id
                                        },
                                        success: function(result){
                                            $(document.body).css({'cursor' : 'default'});
                                            $("button").css({'cursor' : 'default'});
                                            $("select").css({'cursor' : 'default'});
                                            $('button').attr('disabled',false);
                                            $('#pr_acadname_text').attr('readonly',false);
                                            $('#pr_acadname').attr('disabled',false);
        
                                            MyDropdown(result, "#pr_acadcourse");
        
                                        },
                                        error:function(status){
                                            $('#errormessage').html('Error!');
                                        }
                                    });
                                },
                                error:function(status){
                                    $('#errormessage').html('Error!');
                                }
                            });
                        },
                        error:function(status){
                            $('#errormessage').html('Error!');
                        }
                    });
                }
            });
            
        });
        
        $('body').on('click', '#btnSearchGrade', function(){
            $(document.body).css({'cursor' : 'wait'});
            $("button").css({'cursor' : 'wait'});
            $("select").css({'cursor' : 'wait'});
            $('button').attr('disabled',true);

            var lvlid = $('#pr_acadlevel').val();
            var yrid = $('#pr_acadyear').val();
            var stud_id = $('#studid').val();
            var prdid = $('#pr_acadperiod').val();
            var crseid = $('#pr_acadcourse').val();
            $("#div_grades").show();

            $.ajax({
                type:'GET',
                url: '../../model/forms/cog/grade-print-controller.php',
                data:{
                    type : 'SUBJ_ID',
                    levelid : lvlid,
                    yearid   : yrid,
                    periodid : prdid,
                    courseid : crseid,
                    studid : stud_id
                },
                success: function(result){
                    let lineNo = 1;
                    var grade_cnt = 0;
                    var ret = JSON.parse(result);
                    var tblsubjListHead = '';
                    var tblsubjListFoot = '';
                    var requester = "";
                    if(ret.length) {
                        $.each(ret, function(key, value){
                            requester = value.REQUESTER;
                            var subj_list = value.ID
                            var assid = value.ASS_ID
                            var studid = value.STUD_ID
                            if(value.LVL_ID == 1){
                                tblsubjListHead +=
                                    "<tr>" + 
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;'>#</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;'>DESCRIPTION</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;' hidden>SCHEDULE</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;' hidden>TEACHER</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;'></th>" +
                                        "<th scope='col' colspan='4' style='padding:0;margin:0;'>QUARTER</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;'>FINAL GRADE</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;'>REMARKS</th>" +
                                        "<th scope='col' rowspan='2' style='padding:0;margin:0;' hidden>ACTION</th>" +
                                    "</tr>" +
                                    "<tr>" + 
                                        "<th scope='col' style='padding:0;margin:0;'>1st Grading</th>" +
                                        "<th scope='col' style='padding:0;margin:0;'>2nd Grading</th>" +
                                        "<th scope='col' style='padding:0;margin:0;'>3rd Grading</th>" +
                                        "<th scope='col' style='padding:0;margin:0;'>4th Grading</th>" +
                                    "</tr>";
                                    
                                tblsubjListFoot +=
                                "<tr id='total-unit'>" +
                                    "<td colspan='5'></td>" +
                                    "<td colspan='2' style='text-align: right;'> General Average: </td>" +
                                    "<td id='gwa-fg-td'></td>" +
                                    "<td id='gwa-equi-td'></td>" +
                                "</tr>";
                            } else if(value.LVL_ID == 2){
                                tblsubjListHead +=
                                    "<tr>" + 
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;' id='th_lvlid' hidden> College Department </th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Subject Code</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Subject Description</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Units</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'></th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Final Grade</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Equivalent</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Remarks</th>" +
                                    "</tr>";
                                    
                                tblsubjListFoot +=
                                    "<tr id='total-unit'>" +
                                        "<td colspan='2' id='name-unit-td'style='text-align: right; font-weight: bold;'> TOTAL UNITS EARNED: </td>" +
                                        "<td colspan='1' id='total-unit-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' style='text-align: right; font-weight: bold;'> GWA:</td>" +
                                        "<td colspan='1' id='gwa-fg-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' id='gwa-equi-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' ></td>" +
                                    "</tr>";

                            } else if(value.LVL_ID == 3){
                                tblsubjListHead +=
                                    "<tr>" + 
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;' id='th_lvlid' hidden> Graduate School </th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Subject Code</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Subject Description</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Units</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'></th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Final Grade</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Equivalent</th>" +
                                        "<th scope='col' style='padding:0;margin:0;font-size:14px;'>Remarks</th>" +
                                    "</tr>";
                                    
                                tblsubjListFoot +=
                                    "<tr id='total-unit'>" +
                                        "<td colspan='2' id='name-unit-td'style='text-align: right; font-weight: bold;'> TOTAL UNITS EARNED: </td>" +
                                        "<td colspan='1' id='total-unit-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' style='text-align: right; font-weight: bold;'> GWA:</td>" +
                                        "<td colspan='1' id='gwa-fg-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' id='gwa-equi-td' style='text-align: center; font-weight: bold;'></td>" +
                                        "<td colspan='1' ></td>" +
                                    "</tr>";
    
                            } else {

                            }
                            
                            $('#thead-grades').html(tblsubjListHead);
                            $('#thead-grades').show();
                            $('#table-grades #tbody-unit').html(tblsubjListFoot);
                            $('#tbody-unit').show();

                            var unitarr = [];
                            unitarr_sum = 0;

                            var gradearr = [];
                            gradearr_sum = 0;

                            $.ajax({
                                type:'GET',
                                url: '../../model/forms/cog/grade-print-controller.php',
                                data:{
                                    type : 'SUBJ_INFO',
                                    subjectid : subj_list
                                },
                                success: function(result){
                                    $(document.body).css({'cursor' : 'default'});
                                    $("button").css({'cursor' : 'default'});
                                    $("select").css({'cursor' : 'default'});
                                    $('button').attr('disabled',false);
                                    
                                    var retinfo = JSON.parse(result);
                                    var tblsubjList = '';
                                    if(retinfo.length) {
                                        $.each(retinfo, function(key, value){
                                            if(value.LVL_ID == 1){
                                                tblsubjList +=
                                                    "<tr>" +
                                                        "<td style='text-align:CENTER;' >" + lineNo++ + "</td>" + 
                                                        "<td>" + value.DESC + "</td>" +
                                                        "<td style='text-align: center;' id='stat" + value.ID + "' name='td-status'><p style='margin: 0;'></p></td>" +
                                                        "<td id='fg_1_" + value.ID + "'></td>" + 
                                                        "<td id='fg_2_" + value.ID + "'></td>" + 
                                                        "<td id='fg_3_" + value.ID + "'></td>" + 
                                                        "<td id='fg_4_" + value.ID + "'></td>" + 
                                                        "<td id='fg" + value.ID + "' name='fg[]'></td>" +
                                                        "<td id='rem" + value.ID + "'></td>" +
                                                    "</tr>";
                                            } else if(value.LVL_ID == 2){
                                                tblsubjList +=
                                                    "<tr>" + 
                                                        "<td style='text-align:CENTER;' hidden>" + lineNo++ + "</td>" + 
                                                        "<td style='text-align: center;'>" + value.CODE + "</td>" + 
                                                        "<td>" + value.DESC + "</td>" + 
                                                        "<td style='text-align: center;'>" + value.UNIT + ".00</td>" +
                                                        "<td style='text-align: center;' id='stat" + value.ID + "' name='td-status'><p style='margin: 0;'></p></td>" +
                                                        "<td style='text-align: center;' id='fg" + value.ID + "' name='fg[]'></td>" +
                                                        "<td style='text-align: center;' id='equi" + value.ID + "'></td>" +
                                                        "<td style='text-align: center;' id='rem" + value.ID + "'></td>" +
                                                    "</tr>";

                                            } else if(value.LVL_ID == 3){
                                                tblsubjList +=
                                                    "<tr>" + 
                                                        "<td style='text-align:CENTER;' hidden>" + lineNo++ + "</td>" + 
                                                        "<td style='text-align: center;'>" + value.CODE + "</td>" + 
                                                        "<td>" + value.DESC + "</td>" + 
                                                        "<td style='text-align: center;'>" + value.UNIT + ".00</td>" +
                                                        "<td style='text-align: center;' id='stat" + value.ID + "' name='td-status'><p style='margin: 0;'></p></td>" +
                                                        "<td style='text-align: center;' id='fg" + value.ID + "' name='fg[]'></td>" +
                                                        "<td style='text-align: center;' id='equi" + value.ID + "'></td>" +
                                                        "<td style='text-align: center;' id='rem" + value.ID + "'></td>" +
                                                    "</tr>";
                                            } else {
                                                tblsubjList +="<tr>" + 
                                                            "<td colspan='6' style='text-align:CENTER;' > ERROR! PLS CONTACT FCPC ICT DEPARTMENT "+value.LVL_ID+"</td>" + 
                                                        "</tr>";
                                            }
                                        });
                                    } else {
                                        tblsubjList +="<tr>" + 
                                                    "<td style='text-align:CENTER;' > ERROR! PLS CONTACT FCPC ICT DEPARTMENT </td>" + 
                                                "</tr>";
                                    }

                                    $.ajax({
                                        type:'GET',
                                        url: '../../model/forms/cog/grade-print-controller.php',
                                        data:{
                                            type : 'SUBJ_GRADE',
                                            subjectid : subj_list,
                                            studid : studid,
                                            assid : assid
                                        },
                                        success: function(result){
                                            var gwamoto = 0;
                                            var retgrade = JSON.parse(result);
                                            if(retgrade.length) {
                                                $.each(retgrade, function(key, val){
                                                    var comp_grade = val.FINAL_GRADE;
                                                    var subjid = val.SUBJ_ID; 
                                                    grade_cnt++;

                                                    if(lvlid == 1){
                                                        // console.log('BASICED');

                                                        var counter = 1;
                                                        var finalaverage = 0;
                                                        var quarterpercent = [.25, .25, .25, .25];
        
                                                        var comp_grade_array = comp_grade.split(',');
                                                        var checkarray = [];
                                                        $.each(comp_grade_array, function(index, value) {
                                                            var comp_grade_array_final = value.split(':');
                                                            
                                                            if(comp_grade_array_final[1] != 0 || comp_grade_array_final[1] != '0'){
                                                                var a = '#fg_'+counter+'_'+subjid;
                                                                $(a).html(comp_grade_array_final[1]);

                                                                var stat = '#stat'+subjid+' p';
                                                                $(stat).html(val.STATUS);
        
                                                                finalaverage = finalaverage + (parseFloat(comp_grade_array_final[1])*quarterpercent[counter-1]); // this is just the average computation; just made it more flexible
                                                            } else {
                                                                var a = '#fg_'+counter+'_'+subjid;
                                                                $(a).html('');
                                                            }
        
                                                            checkarray.push(comp_grade_array_final);
                                                            
                                                            counter++;
                                                        });
        
                                                        function hasValueIn2DArray(array2D, value) {
                                                            for (var i = 0; i < array2D.length; i++) {
                                                                if (array2D[i].includes(value)) {
                                                                return true;
                                                                }
                                                            }
                                                            return false;
                                                        }
        
                                                        if(!hasValueIn2DArray(checkarray, '0')){
                                                            var a = '#fg'+subjid;
                                                            $(a).html(finalaverage);
                                                            
                                                            var remarks = '#rem'+subjid;
                                                            $(remarks).html(val.REMARKS);
                                                        }
        
                                                        var fgValues = [];
        
                                                        $("td[name='fg[]']").each(function() {
                                                            fgValues.push($(this).text().trim());
                                                        });
        
                                                        // console.log(fgValues);
        
                                                        if (!fgValues.includes('')) {
                                                            // console.log("FINAL GRADE column does not contains '-'");
        
                                                            var sum = fgValues.reduce(function(total, value) {
                                                                    return total + value;
                                                                }, 0);
                                                                
                                                            var gen_average = sum / fgValues.length;
        
                                                            $('#gwa-fg-td').html(gen_average.toFixed(2));
        
                                                        } else {
                                                            // console.log("FINAL GRADE column does contain '-'");
                                                        }

                                                    } else if (lvlid == 2 || lvlid == 3){
                                                        // console.log('TERTIARY');
                                                       $.ajax({
                                                            type:'GET',
                                                            url: '../../model/forms/cog/grade-print-controller.php',
                                                            data:{
                                                                type : 'SUBJ_PERCENT',
                                                                studid : studid,
                                                                comp_grade : comp_grade,
                                                                levelid : lvlid,
                                                                yearid   : yrid,
                                                                periodid : prdid,
                                                                courseid : crseid
                                                            },
                                                            success: function(result){
                                                                // $('#btnPrintGrade').show();

                                                                var retgrade = JSON.parse(result);
                                                                if(retgrade.length) {
                                                                    $.each(retgrade, function(key, item){
                                                                        gradearr.push(item.FINAL_GRADES);

                                                                        var a = '#fg'+subjid;
                                                                        $(a).html(item.FINAL_GRADES);

                                                                        var remarks = '#rem'+subjid;
                                                                        $(remarks).html(val.REMARKS);
                                                                        
                                                                        var equiv = '#equi'+subjid;
                                                                        $(equiv).html(item.EQUI);

                                                                        var stat = '#stat'+subjid+' p';
                                                                        $(stat).html(getStatusText(val.STATUS));
                                                                        gwamoto = parseFloat(gwamoto) + parseFloat(item.FINAL_GRADES);
                                                                    });

                                                                    var subj_cnt = lineNo-1;

                                                                    if(grade_cnt == subj_cnt && subj_cnt == gradearr.length){
                                                                        var dataArray = [];
                                                                        var unitArray = [];
                                                                        var gradeArray = [];
                                                                        var equiArray = [];
                                                                        unitArray_sum = 0;
                                                                        dataArray_sum = 0;
                                                                        equiArray_sum = 0;

                                                                        $('#div_grades table tbody tr').each(function() {
                                                                            var disp_unit = $(this).find('td:eq(3)').text();
                                                                            var disp_grade = $(this).find('td:eq(5)').text();
                                                                            var disp_equi = $(this).find('td:eq(6)').text();
                                                                            var gwa_gradeArray = parseFloat(disp_grade)*parseFloat(disp_unit);
                                                                            var gwa_equiArray = parseFloat(disp_equi)*parseFloat(disp_unit);

                                                                            dataArray.push(gwa_gradeArray);
                                                                            equiArray.push(gwa_equiArray);
                                                                            unitArray.push(parseFloat(disp_unit));
                                                                            gradeArray.push(parseFloat(disp_grade));
                                                                        });
                                                                        
                                                                        $.each(dataArray,function(){dataArray_sum+=parseFloat(this) || 0;});
                                                                        $.each(unitArray,function(){unitArray_sum+=parseFloat(this) || 0;});
                                                                        $.each(equiArray,function(){equiArray_sum+=parseFloat(this) || 0;});

                                                                        student_gwa = dataArray_sum/unitArray_sum;
                                                                        student_equi = equiArray_sum/unitArray_sum;

                                                                        $('#gwa-fg-td').html(student_gwa.toFixed(2));
                                                                        $('#gwa-equi-td').html(student_equi.toFixed(2));
                                                                        $('#total-unit-td').html(unitArray_sum);
                                                                    } else {
                                                                        $('#gwa-fg-td').html('');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    } else {
                                                        console.log('LVLID IS INCORRECT!')
                                                    }
                                                });
                                            }
                                        }
                                    });
                                    $('#grades-no-result').remove();
                                    $('#tbody-grades').html(tblsubjList);
                                    
                                    if (requester.includes('REGISTRAR')) {
                                        $('#btnPrintGrade').show();
                                    }
                                }
                            });
                        });	
                    } else {
                        $(document.body).css({'cursor' : 'default'});
                        $("button").css({'cursor' : 'default'});
                        $("select").css({'cursor' : 'default'});
                        $('button').attr('disabled',false);
                        var tblsubjList = "<tr>" + 
                                    "<td colspan='99' style='text-align: center;' > NO SUBJECTS FOUND! </td>" + 
                                "</tr>";
                        $('#tbody-grades').html(tblsubjList);
                    }
                }
            });
        });

        $('#btnPrintGrade').click(function(){
            var stud_id = $('#studid').val();

            var lvlid = $('#pr_acadlevel').val();
            var yrid = $('#pr_acadyear').val();
            var crseid = $('#pr_acadcourse').val();
            var prdid = $('#pr_acadperiod').val();

            $.ajax({
                type:'GET',
                url: '../../model/forms/cog/grade-print-controller.php',
                data:{
                    type : 'PRINT_INFO',
                    levelid : lvlid,
                    yearid   : yrid,
                    periodid : prdid,
                    courseid : crseid,
                    studid : stud_id
                },
                success: function(result){
                    $('td[name="td-status"] p').hide();

                    var retinfo = JSON.parse(result);
                    if(retinfo.length) {
                        $.each(retinfo, function(key, value){
                            var idno = value.IDNO;
                            var name = value.NAME;
                            var yrlvl = value.YRLVL;
                            var course = value.COURSE;
                            printFunc(idno,name,yrlvl,course);
                        });
                
                        $('td[name="td-status"] p').show(); // does not take effect
                    }
                },
                error:function(status){
                    $('#errormessage').html('Error!');
                }
            });
       });
    });
});

function MyDropdown(result, id){
    var ret = JSON.parse(result);
    if(ret.length) {
        var opt = '';
        $.each(ret, function(key, value) {
            opt += "<option value='" + value.ID + "'>" + value.NAME + "</option>";
        });
    } else {
        opt = "<option value='0'>NONE</option>";
    }
    $(id).html(opt);
}

function printFunc(idno, name, yrlvl, course) {

        console.log('ur herez');

        var tdate = new Date();
        var dd = tdate.getDate(); //yields day
        var MM = tdate.getMonth(); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var currentDate= monthName(MM+1) + " " + dd + ", " + yyyy;
    
        var yrid = $('#pr_acadyear option:selected').text();
        var lvlid = $('#th_lvlid').text();
        var prdid = $('#pr_acadperiod option:selected').text();
    
        var divToPrint = document.getElementById('div_grades');
        var htmlToPrint = '' +
        '<style type="text/css">' +
            'body {' +
                'font-size: 13px;' +
            '}' +
            'table th {' +
                'font-size: 13px;' +
                'text-align: center;' +
            '}' +
            'table td {' +
                'font-size: 13px;' +
                'text-align: left;' +
            '}' +
            'p {' +
                'margin: 0 !important;' +
                'display: inline;' +
            '}' +
            '#table_sign {'+
                'width: 100%;'+
                'margin-block: 50px;'+
            '}'+
            '#table_sign td {'+
                'text-align: center;'+
                'width: 33%;'+
            '}'+
            '#divhr {'+
                'min-height: 100px;'+
                'position: relative;'+
            '}'+
            '#divhr hr {'+
                'position: absolute;'+
                'left: 0;'+
                'bottom: 0;'+
                'width: 100%;'+
                'margin: 0;'+
            '}'+
        '</style>'+
        "<table id='school_info'>" +
            "<tr>" +
                "<td>" +
                    "<img src='../../images/FCPC LOGO.jpg' alt='FCPC_logo' class='img-fluid' width='90' height='80'>" +
                "</td>" +
                "<td style='width: 65%; padding-left: 10px;'>" +
                    "<b> First City Providential College </b><br>" +
                    "Brgy. Narra, Francisco Homes Subd., City of San Jose Del Monte, <br>" +
                    "Bulacan, Philippines <br>" +
                    "(044) 815-6814" +
                "</td>" +
                "<td>" +
                    "<b> Report of Grades </b><br>" +
                    "Academic Year: <p id='acad_year'>"+yrid+"</p><br>" +
                    "<p id='acad_level'>"+lvlid+"</p><br>" +
                    "<p id='acad_period'>"+prdid+"</p> <br>" +
                    "Print Date: "+currentDate +
                "</td>" +
            "</tr>" +
        "</table>" +
        "<br>" +
        "<hr>" +
        "<br>" +
        "<table>" +
            "<tr class='student_info'>" +
                "<td>" +
                    "Student ID: " +
                "</td>" +
                "<td>" +
                    "<p id='stud_idno' style='padding-left: 15px;'>"+idno+"</p>" +
                "</td>" +
            "</tr>" +
            "<tr class='student_info'>" +
                "<td>" +
                    "Name: " +
                "</td>" +
                "<td>" +
                    "<p id='full_name' style='padding-left: 15px;'>"+name+"</p>" +
                "</td>" +
            "</tr>" +
            "<tr class='student_info'>" +
                "<td>" +
                    "Course:" +
                "</td>" +
                "<td>" +
                    "<p id='acad_course' style='padding-left: 15px;'>"+course+"</p>" +
                "</td>" +
            "</tr>" +
            "<tr class='student_info'>" +
                "<td>" +
                    "Year Level:" +
                "</td>" +
                "<td>" +
                    "<p id='acad_yrlvl' style='padding-left: 15px;'>"+yrlvl+"</p>" +
                "</td>" +
            "</tr>" +
        "</table>" +
        "<br>";
        
        htmlToPrint += divToPrint.outerHTML;
        htmlToPrint += "<hr>" +
        "<table id='table_sign'>" +
            "<tr>" +
                "<td>" +
                    "Prepared By:" +
                "</td>" +
                "<td></td>" +
                "<td>" +
                    "Approved By:" +
                "</td>" +
            "</tr>" +
            "<tr style='height:25px;'></tr>" +
            "<tr>" +
                "<td>" +
                    "Frances Jomalyn S. Anastacio, LPT" +
                "</td>" +
                "<td></td>" +
                "<td>" +
                    "Echel Simon-Antero, PhD" +
                "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>" +
                    "Assistant Registrar" +
                "</td>" +
                "<td></td>" +
                "<td>" +
                    "Registrar" +
                "</td>" +
            "</tr>" +
        "</table>" +
        "<hr>" +
        "<h3>College Grading System</h3>" +
        "<table>" +
            "<tr>" +
                "<td style='padding-left: 15px;'><b>1.00</b> = 98 - 100</td>" +
                "<td style='padding-left: 15px;'><b>2.00</b> = 85 - 86</td>" +
                "<td style='padding-left: 15px;'><b>4.00</b> = 70 and below</td>" +
            "</tr>" +
            "<tr>" +
                "<td style='padding-left: 15px;'><b>1.25</b> = 94 - 97</td>" +
                "<td style='padding-left: 15px;'><b>2.25</b> = 80 - 84</td>" +
            "</tr>" +
            "<tr>" +
                "<td style='padding-left: 15px;'><b>1.50</b> = 90 - 93</td>" +
                "<td style='padding-left: 15px;'><b>2.50</b> = 75 - 79</td>" +
            "</tr>" +
            "<tr>" +
                "<td style='padding-left: 15px;'><b>1.75</b> = 87 - 89</td>" +
                "<td style='padding-left: 15px;'><b>2.75</b> = 70 - 74</td>" +
            "</tr>" +
        "</table>" +
        "<div id='divhr'><hr></div>";
        
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();

        // THERE IS AN ERROR HERE WHERE WHEN YOU SOMETIMES CANCEL IN THE PRINT MODULE, IT RESULTS IN AN ERROR.
}

function monthName(name){
    if(name == 1){
        name = 'January';
    } else if(name == 2){
        name = 'February';
    } else if(name == 3){
        name = 'March';
    } else if(name == 4){
        name = 'April';
    } else if(name == 5){
        name = 'May';
    } else if(name == 6){
        name = 'June';
    } else if(name == 7){
        name = 'July';
    } else if(name == 8){
        name = 'August';
    } else if(name == 9){
        name = 'September';
    } else if(name == 10){
        name = 'October';
    } else if(name == 11){
        name = 'November';
    } else if(name == 12){
        name = 'December';
    } else {
        name = 'ERROR';
    }
    return name;
}

function getStatusText(statusCode) {
    var statusTexts = {
        'NOT ENCODED GRADES YET' : 'NOT ENCODED GRADES YET',
        '0' : 'Not Yet Submitted',
        '1' : 'Pending Program Head/Dean Approval',
        '2' : 'Submission Cancelled',
        '3' : 'Pending Registrar Approval',
        '4' : 'Denied by Registrar',
        '5' : 'Viewable on Student Portal',
        '6' : 'Grade Edit Requested',
        '7' : 'Grade Edit Denied',
        '8' : 'In Progress, Visible on Student Portal'
    };

    return statusTexts[statusCode] || "UNKNOWN STATUS: CONTACT FCPC ICT DEPARTMENT";
}