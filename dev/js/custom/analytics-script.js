$(document).ready(function() {
    $('#div-individual-answer').hide();
    $('button').prop('disabled',true);


    var yrlvlid = $('#analytics-acadyrlvl option:selected').val()
    $.ajax({
        type:'GET',
        url: '../../model/forms/analytics/analytics-controller.php',
        data:{
            type : 'STUDENT_LIST_COUNT',
            yrlvlid : yrlvlid
        },
        success: function(result){
            var rsstudJSON = JSON.parse(result);
            if(rsstudJSON.length) {
                $.each(rsstudJSON, function(key, value){
                    $.each(value, function(key2, value2){
                        var cellid = '#div-individual #div-individual-analytics table td[id="'+key2+'"]';
                        $(cellid).text(value2);
                    });
                });

                $('#div-individual #div-individual-analytics table tr').each(function() {
                    var firstTd = $(this).find('td:eq(1)');
                    var secondTd = $(this).find('td:eq(2)');
                    var sum = parseInt(firstTd.text()) + parseInt(secondTd.text());
                    $(this).find('td:eq(3)').text(sum);
                    
                    $('button').prop('disabled',false);
                });
            }
        },
        error:function(status){
            $('#errormessage').html('Error!');
        }
    });

    $('#analytics-acadyrlvl').change(function(){
        $('#tbody-individual tr').remove();
        $('#individual-no-result td').html("NOTHING TO DISPLAY YET");
        $('#individual-no-result').show();
        
        $('button').prop('disabled',true);

        var yrlvlid = $('#analytics-acadyrlvl option:selected').val()
        $.ajax({
            type:'GET',
            url: '../../model/forms/analytics/analytics-controller.php',
            data:{
                type : 'STUDENT_LIST_COUNT',
                yrlvlid : yrlvlid
            },
            success: function(result){
                var rsstudJSON = JSON.parse(result);
                if(rsstudJSON.length) {
                    $.each(rsstudJSON, function(key, value){
                        $.each(value, function(key2, value2){
                            var cellid = '#div-individual #div-individual-analytics table td[id="'+key2+'"]';
                            $(cellid).text(value2);
                        });
                    });

                    $('#div-individual #div-individual-analytics table tr').each(function() {
                        var firstTd = $(this).find('td:eq(1)');
                        var secondTd = $(this).find('td:eq(2)');
                        var sum = parseInt(firstTd.text()) + parseInt(secondTd.text());
                        $(this).find('td:eq(3)').text(sum);
                        
                        $('button').prop('disabled',false);
                    });
                }
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    $('.btnViewStudents').click(function(){
        $('button').prop('disabled', true);

        $('#tbody-individual tr').remove();
        $('#individual-no-result td').html("LOADING...");
        $('#individual-no-result').show();

        var clusterid = $(this).closest('td').attr('id');
        var clusterval = $(this).val();
        var yrlvlid = $('#analytics-acadyrlvl option:selected').val()
        
        $.ajax({
            type:'GET',
            url: '../../model/forms/analytics/analytics-controller.php',
            data:{
                type : 'STUDENT_LIST',
                clusterid: clusterid,
                clusterval: clusterval,
                yrlvlid : yrlvlid
            },
            success: function(result){
                var rsstudJSON = JSON.parse(result);
                var tblstudList = '';
                var lineNo = 1;
                if(rsstudJSON.length) {
                    $.each(rsstudJSON, function(key, value){
                        tblstudList +=
                            "<tr id='"+ value.STUD_ID +"'>" +
                                "<td> "+ lineNo++ +" </td>" + 
                                "<td style='text-align:left;'> "+ value.STUD_NO +" </td>" + 
                                "<td style='text-align:left;' id='name"+ value.STUD_ID +"'> "+ value.FULL_NAME +"</td>" + 
                                "<td style='text-align:left;' id='yrlvl"+ value.YRLVL_ID +"'> "+ value.YRLVL_NAME +"</td>" + 
                                "<td style='text-align:left;' id='yrlvl"+ value.SEC_ID +"'> "+ value.SEC_NAME +"</td>" + 
                                "<td hidden> <button id='btnViewAnswer' name='btnViewAnswer' class='btn btn-success btnViewAnswer' style='font-size:10px;color: white;'> View Answer </button> </td>" + 
                            "</tr>";
                    });
                } else {
                    tblstudList +="<tr>" + 
                                "<td style='text-align:CENTER;' colspan='10' > NO RESPONDENTS FOUND</td>" + 
                            "</tr>";
                }

                $('#individual-no-result').hide();
                $('#tbody-individual').html(tblstudList);
                $('button').prop('disabled', false);
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    // loadData('IS NOT NULL','overall');
    // loadData('IS NOT NULL','cluster1');
    // loadData('IS NOT NULL','cluster2');
    // loadData('IS NOT NULL','cluster3');
    // loadData('IS NOT NULL','cluster4');
    // loadData('= 20','g10'); //20 is number assigned for grade 10 in db
    // loadData('= 21','g11'); //21 is number assigned for grade 11 in db
    // loadData('= 5','g12'); //5 is number assigned for grade 12 in db
    buildTable();
    buildCharts();

    $('body').on('click', '#btnViewAnswer', function(){
        var stud_id = $(this).parents('tr').attr("id");

        $.ajax({
            type:'GET',
            url: '../../model/forms/analytics/analytics-controller.php',
            data:{
                type : 'INDIVIDUAL_ANSWER',
                stud_id : stud_id
            },
            success: function(result){
                $('#div-individual-table').hide();
                $('#div-individual-answer').show();
                surveyTable();
                var surveyJSON = JSON.parse(result);
                if(surveyJSON.length){
                    $.each(surveyJSON, function(key, value){
                        $('#submittime').text(value.SUBMIT_DATE);
                        
                        var chbx_cls = value.RECORDS;
                        var chbx_arr = chbx_cls.split(",");
    
                        $.each(chbx_arr, function(key, item){
                            var chbx_name = 'input[class="'+item+'"]';
                            $(chbx_name).prop( "checked", true );
                            $('input[type="checkbox"]').prop( "disabled", true );
                        });
    
                        var count1 = $('input[id="word1"]:checked').length;
                        var count2 = $('input[id="word2"]:checked').length;
                        var count3 = $('input[id="word3"]:checked').length;
                        var count4 = $('input[id="word4"]:checked').length;
                        var counttotal = $('input[type="checkbox"]:checked').length;
                        $('#table-scores #total_score').text(counttotal);
                        $('#table-scores #cluster1').text(count1);
                        $('#table-scores #cluster2').text(count2);
                        $('#table-scores #cluster3').text(count3);
                        $('#table-scores #cluster4').text(count4);
                    
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
                        
                        $('#btnSubmitResult').attr('disabled',true);
                    });
                } else {
                    $('input[type="checkbox"]').prop( "disabled", false );
                }
            },
            error:function(status){
                $('#errormessage').html('Error!');
            }
        });
    });

    $('#btnBack').click(function(){
        $('#div-individual-table').show();
        $('#div-individual-answer').hide();
    });
});

function loadData(yrlvl,tblname){
    var yrlvlid = ' AND `survey`.`SchlAcadYrlvl_ID` '+yrlvl;
    $.ajax({
        type:'GET',
        url: '../../model/forms/analytics/analytics-controller.php',
        data:{
            type : 'YRLVL_ANSWER',
            yrlvlid : yrlvlid
        },
        success: function(result){
            var surveyJSON = JSON.parse(result);
            
            _text22 = '#div-'+tblname+'-analytics #total_respondents';
            $(_text22).text(surveyJSON.length);
            
            var myArray = [];
            $.each(surveyJSON, function(key, value){
                myArray.push(value.RECORD.split(',')); // this creates a 2-dimensional array of all records
            });

            var elementCounts = {};
            var finalarray = [].concat.apply([], myArray); // merge/concat 2-dimensional array into one array

            finalarray.forEach(element => {
                elementCounts[element] = (elementCounts[element] || 0) + 1; //counts all recurrences in the array
            });
            
            $.each(elementCounts, function(key, value){
                var cellid = '#div-'+tblname+'-table table td[id="'+key+'"]';
                $(cellid).text(value);
                $(cellid).css('background-color','#67ff0050');
            });

            for(let i=1; i<=4; i++){
                sum_cluster = 0;
                _text = "#div-"+tblname+" td[name='name_c"+i+"[]']";
                _text2 = "#div-"+tblname+" #cluster"+i;

                var cluster_array = $(_text).map(function(){return $(this).text();}).get();//get values of array
                $.each(cluster_array,function(){sum_cluster+=parseFloat(this) || 0;});
                
                $(_text2).text(sum_cluster);
            }

            var columnIndex = 1;
                
            // Create an array of the table rows and sort them based on the text content of the td elements in the specified column
            var rows = $("#div-"+tblname+"-analytics #tbl_scores tr").slice(1).sort(function(a, b) {
                var aValue = parseInt($(a).find("td").eq(columnIndex).text());
                var bValue = parseInt($(b).find("td").eq(columnIndex).text());
                return bValue - aValue;
            });
    
            // Assign a rank to each row based on its position in the sorted array
            $(rows).each(function(index) {
                $(this).find("td").eq(2).text(index + 1);
            });
            
            var tds = $("#div-"+tblname+"-analytics #tbl_full tr td");
            var trs = $("#div-"+tblname+"-analytics #tbl_full tr");

            // iterate through each row in the table
            $("#div-"+tblname+"-table #tbl_full tr").each(function() {
                var sum = 0;
                var count = 0;
                // iterate through each td in the row
                $(this).find("td").each(function() {
                // check if the td contains an integer value
                var value = parseInt($(this).text());
                if (!isNaN(value)) {
                    sum += value;
                    count++;
                } 
                });
            
                // calculate the average and append a new td element to the row
                var average = (count > 0) ? (sum / count) : 0;
                $(this).find("td").eq(2).text(average.toFixed(2));
                $(this).find("td").eq(3).text(sum);
            });
            
            _text = "#div-"+tblname+" td[name='Ave[]']";

            var Average_array = $(_text).map(function(){return parseFloat($(this).text());}).get();//get values of array
            var outputArray = [];

            // Calculate the sum of every four elements and push the result into the output array
            for (var i = 0; i < Average_array.length; i += 4) {
              var sum = Average_array[i] + Average_array[i+1] + Average_array[i+2] + Average_array[i+3];
              outputArray.push((sum/4).toFixed(2));
            }

            // Bar Chart Example
            var myLineChart = new Chart(
                $("#div-"+tblname+"-analytics #myBarChart"), {
                    type: 'bar',
                    data: {
                        labels: ["Cluster 1", "Cluster 2", "Cluster 3", "Cluster 4"],
                        datasets: [{
                        label: "Respondents",
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgb(54, 162, 235)",
                        borderWidth: 1,
                        data: outputArray,
                        }],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            time: {
                                unit: 'Cluster'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 4
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            );
        },
        error:function(status){
            $('#errormessage').html('Error!');
        }
    });
};

function buildTable() {
    var tableHeader1 = "" +
    "<table class='table table-hover table-responsive table-bordered' style='width: 95%; margin:0; padding:0;' id='tbl_full'>" +
    "        <thead class='table-primary'>" +
    "        <th style='text-align:left; padding-left: 1rem;'>Questions</th>" +
    "        <th>Topic</th>" +
    "        <th>Average</th>" +
    "        <th>Total</th>" +
    "        <th>Choice 1</th>" +
    "        <th>Choice 2</th>" +
    "        <th>Choice 3</th>" +
    "        <th>Choice 4</th>" +
    "        <th>Choice 5</th>" +
    "        <th>Choice 6</th>" +
    "    </thead>" +
    "    <tbody>" ;
    
    var tableTbodyC1 = "" +
    "        <tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Activities that sound interesting to me are:</td>" +
    "            <td>Health Allied</td>" +
    "            <td id='c1q1' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c1[]' id='c1q1i1'>0</td>" +
    "            <td name='name_c1[]' id='c1q1i2'>0</td>" +
    "            <td name='name_c1[]' id='c1q1i3'>0</td>" +
    "            <td name='name_c1[]' id='c1q1i4'>0</td>" +
    "            <td name='name_c1[]' id='c1q1i5'>0</td>" +
    "            <td id='c1q1i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Personal qualities that describe me are:</td>" +
    "            <td>Health Allied</td>" +
    "            <td id='c1q2' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c1[]' id='c1q2i1'>0</td>" +
    "            <td name='name_c1[]' id='c1q2i2'>0</td>" +
    "            <td name='name_c1[]' id='c1q2i3'>0</td>" +
    "            <td name='name_c1[]' id='c1q2i4'>0</td>" +
    "            <td name='name_c1[]' id='c1q2i5'>0</td>" +
    "            <td id='c1q2i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>In my free time I enjoy:</td>" +
    "            <td>Health Allied</td>" +
    "            <td id='c1q3' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c1[]' id='c1q3i1'>0</td>" +
    "            <td name='name_c1[]' id='c1q3i2'>0</td>" +
    "            <td name='name_c1[]' id='c1q3i3'>0</td>" +
    "            <td id='c1q3i4'>-</td>" +
    "            <td id='c1q3i5'>-</td>" +
    "            <td id='c1q3i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>School subjects/activities that I enjoy or do well in:</td>" +
    "            <td>Health Allied</td>" +
    "            <td id='c1q4' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c1[]' id='c1q4i1'>0</td>" +
    "            <td name='name_c1[]' id='c1q4i2'>0</td>" +
    "            <td name='name_c1[]' id='c1q4i3'>0</td>" +
    "            <td name='name_c1[]' id='c1q4i4'>0</td>" +
    "            <td id='c1q4i5'>-</td>" +
    "            <td id='c1q4i6'>-</td>" +
    "        </tr>";
    
    var tableTbodyC2 = "" +
    "        <tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Activities that sound interesting to me are:</td>" +
    "            <td>Arts & Communication</td>" +
    "            <td id='c2q1' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c2[]' id='c2q1i1'>0</td>" +
    "            <td name='name_c2[]' id='c2q1i2'>0</td>" +
    "            <td name='name_c2[]' id='c2q1i3'>0</td>" +
    "            <td name='name_c2[]' id='c2q1i4'>0</td>" +
    "            <td name='name_c2[]' id='c2q1i5'>0</td>" +
    "            <td name='name_c2[]' id='c2q1i6'>0</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Personal qualities that describe me are:</td>" +
    "            <td>Arts & Communication</td>" +
    "            <td id='c2q2' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c2[]' id='c2q2i1'>0</td>" +
    "            <td name='name_c2[]' id='c2q2i2'>0</td>" +
    "            <td name='name_c2[]' id='c2q2i3'>0</td>" +
    "            <td name='name_c2[]' id='c2q2i4'>0</td>" +
    "            <td name='name_c2[]' id='c2q2i5'>0</td>" +
    "            <td id='c2q2i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>In my free time I enjoy:</td>" +
    "            <td>Arts & Communication</td>" +
    "            <td id='c2q3' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c2[]' id='c2q3i1'>0</td>" +
    "            <td name='name_c2[]' id='c2q3i2'>0</td>" +
    "            <td name='name_c2[]' id='c2q3i3'>0</td>" +
    "            <td id='c2q3i4'>-</td>" +
    "            <td id='c2q3i5'>-</td>" +
    "            <td id='c2q3i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>School subjects/activities that I enjoy or do well in:</td>" +
    "            <td>Arts & Communication</td>" +
    "            <td id='c2q4' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c2[]' id='c2q4i1'>0</td>" +
    "            <td name='name_c2[]' id='c2q4i2'>0</td>" +
    "            <td name='name_c2[]' id='c2q4i3'>0</td>" +
    "            <td name='name_c2[]' id='c2q4i4'>0</td>" +
    "            <td id='c2q4i5'>-</td>" +
    "            <td id='c2q4i6'>-</td>" +
    "        </tr>";
    
    var tableTbodyC3 = "" +
    "        <tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Activities that sound interesting to me are:</td>" +
    "            <td>Business & Management</td>" +
    "            <td id='c3q1' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c3[]' id='c3q1i1'>0</td>" +
    "            <td name='name_c3[]' id='c3q1i2'>0</td>" +
    "            <td name='name_c3[]' id='c3q1i3'>0</td>" +
    "            <td name='name_c3[]' id='c3q1i4'>0</td>" +
    "            <td name='name_c3[]' id='c3q1i5'>0</td>" +
    "            <td id='c3q1i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Personal qualities that describe me are:</td>" +
    "            <td>Business & Management</td>" +
    "            <td id='c3q2' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c3[]' id='c3q2i1'>0</td>" +
    "            <td name='name_c3[]' id='c3q2i2'>0</td>" +
    "            <td name='name_c3[]' id='c3q2i3'>0</td>" +
    "            <td name='name_c3[]' id='c3q2i4'>0</td>" +
    "            <td name='name_c3[]' id='c3q2i5'>0</td>" +
    "            <td id='c3q2i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>In my free time I enjoy:</td>" +
    "            <td>Business & Management</td>" +
    "            <td id='c3q3' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c3[]' id='c3q3i1'>0</td>" +
    "            <td name='name_c3[]' id='c3q3i2'>0</td>" +
    "            <td name='name_c3[]' id='c3q3i3'>0</td>" +
    "            <td id='c3q3i4'>-</td>" +
    "            <td id='c3q3i5'>-</td>" +
    "            <td id='c3q3i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>School subjects/activities that I enjoy or do well in:</td>" +
    "            <td>Business & Management</td>" +
    "            <td id='c3q4' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c3[]' id='c3q4i1'>0</td>" +
    "            <td name='name_c3[]' id='c3q4i2'>0</td>" +
    "            <td name='name_c3[]' id='c3q4i3'>0</td>" +
    "            <td name='name_c3[]' id='c3q4i4'>0</td>" +
    "            <td id='c3q4i5'>-</td>" +
    "            <td id='c3q4i6'>-</td>" +
    "        </tr>";
    
    var tableTbodyC4 = "" +
    "        <tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Activities that sound interesting to me are:</td>" +
    "            <td>Public Service/Social/Behavioral Science/Humanities</td>" +
    "            <td id='c4q1' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c4[]' id='c4q1i1'>0</td>" +
    "            <td name='name_c4[]' id='c4q1i2'>0</td>" +
    "            <td name='name_c4[]' id='c4q1i3'>0</td>" +
    "            <td name='name_c4[]' id='c4q1i4'>0</td>" +
    "            <td name='name_c4[]' id='c4q1i5'>0</td>" +
    "            <td id='c4q1i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>Personal qualities that describe me are:</td>" +
    "            <td>Public Service/Social/Behavioral Science/Humanities</td>" +
    "            <td id='c4q2' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c4[]' id='c4q2i1'>0</td>" +
    "            <td name='name_c4[]' id='c4q2i2'>0</td>" +
    "            <td name='name_c4[]' id='c4q2i3'>0</td>" +
    "            <td name='name_c4[]' id='c4q2i4'>0</td>" +
    "            <td name='name_c4[]' id='c4q2i5'>0</td>" +
    "            <td id='c4q2i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>In my free time I enjoy:</td>" +
    "            <td>Public Service/Social/Behavioral Science/Humanities</td>" +
    "            <td id='c4q3' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c4[]' id='c4q3i1'>0</td>" +
    "            <td name='name_c4[]' id='c4q3i2'>0</td>" +
    "            <td name='name_c4[]' id='c4q3i3'>0</td>" +
    "            <td id='c4q3i4'>-</td>" +
    "            <td id='c4q3i5'>-</td>" +
    "            <td id='c4q3i6'>-</td>" +
    "        </tr><tr>" +
    "            <td style='text-align:left; padding-left: 1rem;'>School subjects/activities that I enjoy or do well in:</td>" +
    "            <td>Public Service/Social/Behavioral Science/Humanities</td>" +
    "            <td id='c4q4' name='Ave[]'></td>" +
    "            <td></td>" +
    "            <td name='name_c4[]' id='c4q4i1'>0</td>" +
    "            <td name='name_c4[]' id='c4q4i2'>0</td>" +
    "            <td name='name_c4[]' id='c4q4i3'>0</td>" +
    "            <td name='name_c4[]' id='c4q4i4'>0</td>" +
    "            <td id='c4q4i5'>-</td>" +
    "            <td id='c4q4i6'>-</td>" +
    "        </tr>";
    
    var tableHeader2 = "" +
    "    </tbody>" +
    "</table>";
    
    $('#div-overall-table').html(tableHeader1+tableTbodyC1+tableTbodyC2+tableTbodyC3+tableTbodyC4+tableHeader2);
    $('#div-g10-table').html(tableHeader1+tableTbodyC1+tableTbodyC2+tableTbodyC3+tableTbodyC4+tableHeader2);
    $('#div-g11-table').html(tableHeader1+tableTbodyC1+tableTbodyC2+tableTbodyC3+tableTbodyC4+tableHeader2);
    $('#div-g12-table').html(tableHeader1+tableTbodyC1+tableTbodyC2+tableTbodyC3+tableTbodyC4+tableHeader2);
    $('#div-g12-table').html(tableHeader1+tableTbodyC1+tableTbodyC2+tableTbodyC3+tableTbodyC4+tableHeader2);

    $('#div-cluster1-table').html(tableHeader1+tableTbodyC1+tableHeader2);
    $('#div-cluster2-table').html(tableHeader1+tableTbodyC2+tableHeader2);
    $('#div-cluster3-table').html(tableHeader1+tableTbodyC3+tableHeader2);
    $('#div-cluster4-table').html(tableHeader1+tableTbodyC4+tableHeader2);
};

function buildCharts() {
    var tableHeader1 = "" +
    "<table class='table table-borderless' style='width: 100%; table-layout:fixed;'>" +
    "    <tr>" +
    "        <td id='total-respondents' style='width:25%'>" +
    "            <div class='row'>" +
    "                    <div class='col-6 rounded shadow' style='padding: 0 1rem 1rem 1rem; margin-left:1rem; background: linear-gradient(to right, rgba(0,113,248), rgba(79,172,254,0.5));'>" +
    "                    <div>" +
    "                        <h1 class='display-3 font-weight-bold text-white text-start' style='margin:0; padding:0;' id='total_respondents'>0</h1>" +
    "                    </div>" +
    "                    <div>" +
    "                        <h6 class='font-weight-light text-white text-start' style='margin:0; padding:0;'>Total Respondents:</h6>" +
    "                    </div>" +
    "                </div>" +
    "            </div>" +
    "        </td>" +
    "        <td class='text-center' style='width:25%' rowspan='2'>" +
    "            <div class='col-xl-11 d-inline-block'>" +
    "                <div class='card md-2 rounded shadow'>" +
    "                    <div class='card-header'>" +
    "                        Bar Chart Example" +
    "                    </div>" +
    "                    <div class='card-body'><canvas id='myBarChart' width='100%' height='40'></canvas></div>" +
    "                </div>" +
    "            </div>" +
    "        </td>" +
    "    </tr>" +
    "    <tr>" +
    "        <td class='' style='width:25%'>";
    
    var tableClusterRanking = "" +
    "            <table class='table table-bordered rounded shadow' id='tbl_scores'>" +
    "                <thead class='table-primary'>" +
    "                    <th class='text-start'>Cluster: </th>" +
    "                    <th>Score: </th>" +
    "                    <th>Rank: </th>" +
    "                </thead>" +
    "                <tr>" +
    "                    <td class='text-start'>Cluster 1: Healh Allied</td>" +
    "                    <td id='cluster1' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>Cluster 2: Arts & Communication</td>" +
    "                    <td id='cluster2' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>Cluster 3: Business & Management</td>" +
    "                    <td id='cluster3' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>Cluster 4: Public Service/Social/Behavioral Science/Humanities</td>" +
    "                    <td id='cluster4' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "            </table>" ;
    
    var tableClusterDetailRanking = "" +
    "            <table class='table table-bordered rounded shadow' id='tbl_scores'>" +
    "                <thead class='table-primary'>" +
    "                    <th class='text-start'>Question: </th>" +
    "                    <th>Score: </th>" +
    "                    <th>Rank: </th>" +
    "                </thead>" +
    "                <tr>" +
    "                    <td class='text-start'>Activities that sound interesting to me are:</td>" +
    "                    <td id='cluster1' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>Personal qualities that describe me are:</td>" +
    "                    <td id='cluster2' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>In my free time I enjoy:</td>" +
    "                    <td id='cluster3' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "                <tr>" +
    "                    <td class='text-start'>School subjects/activities that I enjoy or do well in:</td>" +
    "                    <td id='cluster4' name='cluster[]'>0</td>" +
    "                    <td name='rank[]'> - </td>" +
    "                </tr>" +
    "            </table>" ;
    
    var tableHeader2 = "" +
    "        </td>" +
    "    </tr>" +
    "</table>";
    
    $('#div-overall-analytics').html(tableHeader1+tableClusterRanking+tableHeader2);
    $('#div-g10-analytics').html(tableHeader1+tableClusterRanking+tableHeader2);
    $('#div-g11-analytics').html(tableHeader1+tableClusterRanking+tableHeader2);
    $('#div-g12-analytics').html(tableHeader1+tableClusterRanking+tableHeader2);

    $('#div-cluster1-analytics').html(tableHeader1+tableClusterDetailRanking+tableHeader2);
    $('#div-cluster2-analytics').html(tableHeader1+tableClusterDetailRanking+tableHeader2);
    $('#div-cluster3-analytics').html(tableHeader1+tableClusterDetailRanking+tableHeader2);
    $('#div-cluster4-analytics').html(tableHeader1+tableClusterDetailRanking+tableHeader2);
};

function surveyTable(){
    var htmlToPrint = "" +
    " <nav>"+
    "     <div class='nav nav-tabs' id='nav-tab' role='tablist'>"+
    "         <button class='nav-link active' id='nav-cluster1-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster1' type='button' role='tab' aria-controls='nav-cluster1' aria-selected='true'>Cluster 1</button>"+
    "         <button class='nav-link' id='nav-cluster2-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster2' type='button' role='tab' aria-controls='nav-cluster2' aria-selected='false'>Cluster 2</button>"+
    "         <button class='nav-link' id='nav-cluster3-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster3' type='button' role='tab' aria-controls='nav-cluster3' aria-selected='false'>Cluster 3</button>"+
    "         <button class='nav-link' id='nav-cluster4-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster4' type='button' role='tab' aria-controls='nav-cluster4' aria-selected='false'>Cluster 4</button>"+
    "         <button class='nav-link' id='nav-cluster5-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster5' type='button' role='tab' aria-controls='nav-cluster5' aria-selected='false' hidden>Cluster 5</button>"+
    "     </div>"+
    " </nav>"+
    " <div class='tab-content' id='nav-tabContent' style='margin-top: 1rem;'>"+
    "     <div class='tab-pane fade show active' id='nav-cluster1' role='tabpanel' aria-labelledby='nav-cluster1-tab'>"+
    "         <div id='div-cluster1'>"+
    "             <h4>Health Allied</h4>"+
    "             <p>Activities that sound interesting to me are:</p>"+
    "                 <input type='checkbox' id='word1' class='c1q1i1'><label>Helping people stay healthy </label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q1i2'><label>Helping sick people</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q1i3'><label>Taking care of animals' injuries and illnesses</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q1i4'><label>Studying anatomy and disease </label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q1i5'><label>Helping with sports injuries</label><br><br>"+
    "             <p>Personal qualities that describe me are:</p>"+
    "                 <input type='checkbox' id='word1' class='c1q2i1'><label>Compassionate and caring  </label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q2i2'><label>Good listener</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q2i3'><label>Good at following directions</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q2i4'><label>Conscientious and careful</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q2i5'><label>Patient</label><br> <br>"+
    "             <p>In my free time I enjoy:</p>"+
    "                 <input type='checkbox' id='word1' class='c1q3i1'><label>Volunteering in a hospital</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q3i2'><label>Taking care of pets</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q3i3'><label>Working at being healthy</label><br><br>"+
    "             <p>School subjects/activities that I enjoy or do well in:</p>"+
    "                 <input type='checkbox' id='word1' class='c1q4i1'><label>Math</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q4i2'><label>Science</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q4i3'><label>Biology</label><br>"+
    "                 <input type='checkbox' id='word1' class='c1q4i4'><label>Chemistry</label><br><br>"+
    "         </div>"+
    "     </div>"+
    "     <div class='tab-pane fade' id='nav-cluster2' role='tabpanel' aria-labelledby='nav-cluster2-tab'>"+
    "         <div id='div-cluster2'>"+
    "             <h4>Arts & Communication</h4>"+
    "             <p>Activities that sound interesting to me are:</p>"+
    "                 <input type='checkbox' id='word2' class='c2q1i1'><label>Reading or writing stories or articles</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q1i2'><label>Creating scenery for plays</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q1i3'><label>Designing advertisements </label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q1i4'><label>Taking photographs</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q1i5'><label>Acting in a play or movie </label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q1i6'><label>Listening to/playing music</label><br><br>"+
    "             <p>Personal qualities that describe me are:</p>"+
    "                 <input type='checkbox' id='word2' class='c2q2i1'><label>Imaginative</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q2i2'><label>Creative</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q2i3'><label>Outgoing</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q2i4'><label>Like using hands to create things</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q2i5'><label>Performer</label><br><br>"+
    "             <p>In my free time I enjoy:</p>"+
    "                 <input type='checkbox' id='word2' class='c2q3i1'><label>Working on the school newspaper</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q3i2'><label>Acting in a play</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q3i3'><label>Painting pictures, drawing</label><br><br>"+
    "             <p>School subjects/activities that I enjoy or do well in:</p>"+
    "                 <input type='checkbox' id='word2' class='c2q4i1'><label>Speech/drama</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q4i2'><label>Choir/chorus/band/orchestra</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q4i3'><label>Creative writing</label><br>"+
    "                 <input type='checkbox' id='word2' class='c2q4i4'><label>Art</label><br><br>"+
    "         </div>"+
    "     </div>"+
    "     <div class='tab-pane fade' id='nav-cluster3' role='tabpanel' aria-labelledby='nav-cluster3-tab'>"+
    "         <div id='div-cluster3'>"+
    "             <h4>Business & Management</h4>"+
    "             <p>Activities that sound interesting to me are:</p>"+
    "                 <input type='checkbox' id='word3' class='c3q1i1'><label>Interviewing people</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q1i2'><label>Working with a computer program</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q1i3'><label>Making forms or banners</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q1i4'><label>Taking notes at meetings</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q1i5'><label>Being in charge of a group project</label><br><br>"+
    "             <p>Personal qualities that describe me are:</p>"+
    "                 <input type='checkbox' id='word3' class='c3q2i1'><label>Practical</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q2i2'><label>Independent</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q2i3'><label>Organized</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q2i4'><label>Like to use office equipment</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q2i5'><label>Like to be around people</label><br><br>"+
    "             <p>In my free time I enjoy:</p>"+
    "                 <input type='checkbox' id='word3' class='c3q3i1'><label>Being in a speech contest or debate</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q3i2'><label>Working with a computer</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q3i3'><label>Creating a business </label><br><br>"+
    "             <p>School subjects/activities that I enjoy or do well in:</p>"+
    "                 <input type='checkbox' id='word3' class='c3q4i1'><label>Computers</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q4i2'><label>Language arts</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q4i3'><label>Math</label><br>"+
    "                 <input type='checkbox' id='word3' class='c3q4i4'><label>Marketing</label><br><br>"+
    "         </div>"+
    "     </div>"+
    "     <div class='tab-pane fade' id='nav-cluster4' role='tabpanel' aria-labelledby='nav-cluster4-tab'>"+
    "         <div id='div-cluster4'>"+
    "             <h4>Public Service/Social/Behavioral Science/Humanities</h4>"+
    "             <p>Activities that sound interesting to me are:</p>"+
    "                 <input type='checkbox' id='word4' class='c4q1i1'><label>Helping people solve problems</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q1i2'><label>Working with children</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q1i3'><label>Working with the elderly</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q1i4'><label>Preparing food</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q1i5'><label>Solving a mystery</label><br><br>"+
    "             <p>Personal qualities that describe me are:</p>"+
    "                 <input type='checkbox' id='word4' class='c4q2i1'><label>Friendly</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q2i2'><label>Open</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q2i3'><label>Outgoing</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q2i4'><label>Good at making decisions</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q2i5'><label>Good Listener</label><br><br>"+
    "             <p>In my free time I enjoy:</p>"+
    "                 <input type='checkbox' id='word4' class='c4q3i1'><label>Tutoring young children</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q3i2'><label>Helping with a community project</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q3i3'><label>Coaching kids in a sport</label><br><br>"+
    "             <p>School subjects/activities that I enjoy or do well in:</p>"+
    "                 <input type='checkbox' id='word4' class='c4q4i1'><label>Language arts</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q4i2'><label>Child development</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q4i3'><label>Psychology/Sociology</label><br>"+
    "                 <input type='checkbox' id='word4' class='c4q4i4'><label>History</label><br><br>"+
    "         </div>"+
    "         <div style='margin-bottom: 2.5rem;'>"+
    "             <input type='button' id='btnViewSummary' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewSummary' style='margin-right: 1rem; float: right;' value='View Results'/>"+
    "         </div>"+
    "     </div>"+
    " </div>"+
    "<div class='modal fade' id='viewSummary' tabindex='-1' aria-labelledby='label-modal' aria-hidden='true'>"+
    "  <div class='modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered'>"+
    "      <div class='modal-content'>"+
    "          <div class='modal-header'>"+
    "              <p class='modal-title fs-5' id='label-modal' style='font-size: 1.75rem !important;'>Summary</p>"+
    "              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>"+
    "          </div>"+
    "          <div class='modal-body'>"+
    "              <div id='div-summary' class='row d-flex p-2'>"+
    "                  <div id='divmessage' style='border: solid 2px #1cad00bf; background-color: #67ff0030; border-radius: 5px; margin-left: 1rem; padding: .5rem 1rem; width:95%;'>"+
    "                      <p style='display: inline;'> You have successfully submitted the result! </p><p id='submittime' style='margin: 0; padding: 0; display: inline;'>-</p>"+
    "                  </div>"+
    "                  <style>"+
    "                      #table-scores td, #table-scores th, #table-rank td, #table-rank th{"+
    "                          font-size: 14px;"+
    "                      }"+
    "                      #cluster_desc{"+
    "                          text-align: left;"+
    "                      }"+
    "                      td[name='cluster[]']{"+
    "                          width: 15%;"+
    "                      }"+
    "                  </style>"+
    "                  <table class='table table-responsive table-bordered' style='margin:1rem; width:95%;' id='table-scores'>"+
    "                      <thead class='table-primary'>"+
    "                          <tr>"+
    "                              <th>#</th>"+
    "                              <th colspan='2'>Score: </th>"+
    "                              <th>Rank:</th>"+
    "                          </tr>"+
    "                      </thead>"+
    "                      <tbody>"+
    "                          <tr>"+
    "                              <td> 1 </td>"+
    "                              <td id='cluster_desc'> Cluster 1: Health Allied</td>"+
    "                              <td id='cluster1' name='cluster[]'>0</td>"+
    "                              <td name='rank[]'> - </td>"+
    "                          </tr>"+
    "                          <tr>"+
    "                              <td> 2 </td>"+
    "                              <td id='cluster_desc'> Cluster 2: Arts & Communication</td>"+
    "                              <td id='cluster2' name='cluster[]'>0</td>"+
    "                              <td name='rank[]'> - </td>"+
    "                          </tr>"+
    "                          <tr>"+
    "                              <td> 3 </td>"+
    "                              <td id='cluster_desc'> Cluster 3: Business & Management</td>"+
    "                              <td id='cluster3' name='cluster[]'>0</td>"+
    "                              <td name='rank[]'> - </td>"+
    "                          </tr>"+
    "                          <tr>"+
    "                              <td> 4 </td>"+
    "                              <td id='cluster_desc'> Cluster 4: Public Service/Social/Behavioral Science/Humanities</td>"+
    "                              <td id='cluster4' name='cluster[]'>0</td>"+
    "                              <td name='rank[]'> - </td>"+
    "                          </tr>"+
    "                          <tr>"+
    "                              <td colspan='2' style='text-align: right;'> Total Score: </td>"+
    "                              <td id='total_score' name='total_score'>0</td>"+
    "                              <td>  </td>"+
    "                          </tr>"+
    "                      </tbody>"+
    "                  </table>"+
    "              </div>"+
    "          </div>"+
    "          <div class='modal-footer'>"+
    "              <!-- <button type='button' class='btn btn-primary bntClose' data-bs-dismiss='modal'>Okay</button> -->"+
    "          </div>"+
    "      </div>"+
    "  </div>"+
    "</div>";
    
    $('#div-individual-question').html(htmlToPrint);
};