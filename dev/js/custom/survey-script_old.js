$(document).ready(function() {
    $('#divmessage').hide();
    $("#viewModal").modal('show');
    $('#btnSubmitResult').attr('disabled',true);

    $('#btnSubmitResult2').hide()
    $('#btnSubmitResult2').attr('disabled',true);

    $('#btnViewSummary').attr('disabled',true);
    $('#btnViewSummary').hide();
    $('input[type="checkbox"]').prop( "disabled", true );

    $('.unselectable').click(function(){
        // Find the associated checkbox using the class name
        var name = $(this).attr('name');
        var checkbox = $('.' + name);
        // Toggle the checkbox
        // checkbox.prop('checked', !checkbox.is(':checked'));

        checkbox.click();
    });
    $.ajax({
        type:'GET',
        url: '../../model/forms/careersurvey/survey-controller_old.php',
        data:{
            type : 'SURVEY_ANSWER'
        },
        success: function(result){
            var surveyJSON = JSON.parse(result);
            if(surveyJSON.length){
                $.each(surveyJSON, function(key, value){
                    $('#divmessage').show();
                    $('#submittime').text(value.SUBMIT_DATE);

                    var chbx_cls = value.SURVEY_RECORD;
                    var chbx_arr = chbx_cls.split(",");

                    $.each(chbx_arr, function(key, item){
                        var chbx_name = 'input[class="'+item+'"]';
                        $(chbx_name).prop( "checked", true );
                        $('input[type="checkbox"]').prop( "disabled", false );
                    });

                    if(value.LVLID == 1 && value.YRLVLID == 20){//grade 10
                        $('#linkcode').text('381-10762');
                    } else if(value.LVLID == 1 && value.YRLVLID == 21){//grade 11
                        $('#linkcode').text('381-10763');
                    } else if(value.LVLID == 1 && value.YRLVLID == 5){//grade 12
                        $('#linkcode').text('381-10764');
                    } else if(value.LVLID == 2){
                        $('#linkcode').text('381-10932');
                    } else {
                        $('#linkcode').text(value.YRLVLID);
                    }

                    var count1 = $('input[id="word1"]:checked').length;
                    var count2 = $('input[id="word2"]:checked').length;
                    var count3 = $('input[id="word3"]:checked').length;
                    var count4 = $('input[id="word4"]:checked').length;
                    var count5 = $('input[id="word5"]:checked').length;
                    var counttotal = $('input[type="checkbox"]:checked').length;
                    $('#total_score').text(counttotal);
                    $('#cluster1').text(count1);
                    $('#cluster2').text(count2);
                    $('#cluster3').text(count3);
                    $('#cluster4').text(count4);
                    $('#cluster5').text(count5);
                
                    var columnIndex = 2;
            
                    // Create an array of the table rows and sort them based on the text content of the td elements in the specified column
                    var rows = $("#table-scores tr").slice(1).sort(function(a, b) {
                        var aValue = parseInt($(a).find("td").eq(columnIndex).text());
                        var bValue = parseInt($(b).find("td").eq(columnIndex).text());
                        return bValue - aValue;
                    });
            
                    // Assign a rank to each row based on its position in the sorted array
                    $(rows).each(function(index) {
                        $(this).find("td").eq(3).text(index + 1);
                        $('td[name="rank[]"]:contains(1)').closest('tr').css("background-color", "#67ff0030");
                    });
                    
                    if(value.STATUS == 1){
                        $('#btnSubmitResult2').attr('disabled',false);
                        $('#btnSubmitResult2').show();
                        $('#btnSubmitResult').attr('disabled',true);
                        $('#btnSubmitResult').hide();
                        $('#btnViewSummary').attr('disabled',true);
                        $('#btnViewSummary').hide();
                    } else if(value.STATUS == 2){
                        $('#btnSubmitResult2').attr('disabled',true);
                        $('#btnSubmitResult2').hide();
                        $('#btnSubmitResult').attr('disabled',true);
                        $('#btnSubmitResult').hide();
                        $('#btnViewSummary').attr('disabled',false);
                        $('#btnViewSummary').show();
                    }
                });
            } else {
                $('input[type="checkbox"]').prop( "disabled", false );
            }
        },
        error:function(status){
            $('#errormessage').html('Error!');
        }
    });

    $.ajax({
        type:'GET',
        url: '../../model/forms/careersurvey/survey-controller_old.php',
        data:{
            type : 'ONLOAD'
        },
        success: function(result){
            var rsstudJSON = JSON.parse(result);
            
            $.each(rsstudJSON, function(key, value){
                $('#levelid').text(value.LVLID);
                $('#yearid').text(value.YRID);
                $('#yearlevelid').text(value.YRLVLID);
                $('#periodid').text(value.PRDID);
                $('#courseid').text(value.CRSEID);
                $('input[type="checkbox"]').prop( "disabled", false );
            });
        },
        error:function(status){
            $('#errormessage').html('Error!');
        }
    });

    $('input[id="word1"]').change(function() {
        var count = $('input[id="word1"]:checked').length;
        $('#cluster1').text(count);
    });

    $('input[id="word2"]').change(function() {
        var count = $('input[id="word2"]:checked').length;
        $('#cluster2').text(count);
    });

    $('input[id="word3"]').change(function() {
        var count = $('input[id="word3"]:checked').length;
        $('#cluster3').text(count);
    });

    $('input[id="word4"]').change(function() {
        var count = $('input[id="word4"]:checked').length;
        $('#cluster4').text(count);
    });

    $('input[id="word5"]').change(function() {
        var count = $('input[id="word5"]:checked').length;
        $('#cluster5').text(count);
    });

    $('input[type="checkbox"]').change(function() {
        var count = $('input[type="checkbox"]:checked').length;
        if(count != 0){
            $('#total_score').text(count);
            var columnIndex = 2;

            // Create an array of the table rows and sort them based on the text content of the td elements in the specified column
            var rows = $("#table-scores tr").slice(1).sort(function(a, b) {
                var aValue = parseInt($(a).find("td").eq(columnIndex).text());
                var bValue = parseInt($(b).find("td").eq(columnIndex).text());
                return bValue - aValue;
            });

            // Assign a rank to each row based on its position in the sorted array
            $(rows).each(function(index) {
                $(this).find("td").eq(3).text(index + 1);
                $('td[name="rank[]"]:contains(1)').closest('tr').css("background-color", "#67ff0030");
                $('td[name="rank[]"]:not(:contains(1))').closest('tr').css("background-color", "#ffffff00");
            });

            $('#btnSubmitResult').attr('disabled',false);
        } else {
            $('#btnSubmitResult').attr('disabled', true);
        }
        
    });

    $('#btnSubmitResult').click(function(){
        $('#btnSubmitResult').prop( "disabled", true );
        SurveyProcess('SURVEY_SUBMIT');
        $('#btnSubmitResult').hide();
    });
    
    $('#btnSubmitResult2').click(function(){
        $('#btnSubmitResult2').prop( "disabled", true );
        SurveyProcess('SURVEY_SUBMIT_UPDATE');
        $('#btnSubmitResult2').hide();
    });
});

function SurveyProcess(type){
    var levelid = $('#levelid').text();
    var yearid = $('#yearid').text();
    var yearlevelid = $('#yearlevelid').text();
    var periodid = $('#periodid').text();
    var courseid = $('#courseid').text();

    var total_score = $('#total_score').text();
    var arr_cluster = $("td[name='cluster[]']").map(function(){return $(this).text();}).get();//get values of array
    var arr_rank = $("td[name='rank[]']").map(function(){return $(this).text();}).get();//get values of array
    var arr_submit = [];
    var str_submit = "";

    var chbx = $("input[type='checkbox']:checked").map(function(){return $(this).attr('class');}).get();//get values of array

    if(arr_cluster.length == arr_rank.length){
        for(var i=0; i<arr_cluster.length; i++ ){
            arr_submit.push(arr_cluster[i]+":"+arr_rank[i]);
        }

        for(var i=0; i<arr_submit.length; i++ ){
            str_submit = str_submit + arr_submit[i] + ',';
        }

        str_submit = str_submit.slice(0,-1);
        var str_chbx = chbx.toString();

        $.ajax({
            type:'GET',
            url: '../../model/forms/careersurvey/survey-controller_old.php',
            data:{
                type : type,
                arr_submit : arr_submit,
                total_score : total_score,
                str_chbx : str_chbx,
                levelid : levelid,
                yearid : yearid,
                yearlevelid : yearlevelid,
                periodid : periodid,
                courseid : courseid
            },
            success: function(result){
                $.ajax({
                    type:'GET',
                    url: '../../model/forms/careersurvey/survey-controller_old.php',
                    data:{
                        type : 'SURVEY_ANSWER'
                    },
                    success: function(result){
                        var surveyJSON = JSON.parse(result);
                        if(surveyJSON.length){
                            $.each(surveyJSON, function(key, value){
                                $('#divmessage').show();
                                $('#submittime').text(value.SUBMIT_DATE);

                                
                                if(value.LVLID == 1 && value.YRLVLID == 20){//grade 10
                                    $('#linkcode').text('381-10762');
                                } else if(value.LVLID == 1 && value.YRLVLID == 21){//grade 11
                                    $('#linkcode').text('381-10763');
                                } else if(value.LVLID == 1 && value.YRLVLID == 5){//grade 12
                                    $('#linkcode').text('381-10764');
                                } else if(value.LVLID == 2){
                                    $('#linkcode').text('381-10932');
                                } else {
                                    $('#linkcode').text(value.YRLVLID);
                                }

                                $('input[type="checkbox"]').attr('disabled',true);
                                $('#btnViewSummary').attr('disabled',false);
                                $('#btnViewSummary').show();
                                $('#btnViewSummary').click();
                            });
                        } else {
                            $('input[type="checkbox"]').prop( "disabled", false );
                        }
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

    } else {
        alert('ERROR: CONTACT ICT DEPARTMENT.')
    }
}