<?php
    include 'subject-controller.php';
?>
<section id="subject-schedule">
    <div class="container" style="margin-block: 2rem">
        <div class="row" style="text-align: center;"> 
            <div class="col-md-3">
                <div id="dropdown-academic-level">
                    <label>ACADEMIC LEVEL</label>

                    <select id='subj_acadlvl' name='acadlvl' class='form-control' style='text-align:center;' required>
                        <option value="0"> -- SELECT ACADEMIC LEVEL -- </option>

                    <?php
                        foreach($fetchacadlevel as $regitem){
                            $acadlvl = "<option value='".$regitem['LVL_ID']."'>". $regitem['LVL_NAME'] ."</option>";
                            echo $acadlvl;
                        }
                    ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div id="dropdown-academic-year">
                </div>
            </div>

            <div class="col-md-3">
                <div id="dropdown-academic-period">
                </div>
            </div>

            <div class="col-md-3">
                <div id="dropdown-academic-course">
                </div>
            </div>


        </div>
    </div>
    <hr>
    
    <div class="container" id="table-list"  style="margin-top: 2rem">
        <div id="prereg-data">
            <h3 style='color: #7f878f'> Nothing to display yet.</h3>
        </div>

    </div>
        
</section>

<script>
    $(document).ready(function(){
        $('#subj_acadlvl').change(function(){
            var level_id = $(this).val();

            $.ajax({
                type: "POST",
                url: "../../model/class/schoolenrollmentsubjectschedyear-class.php",
                data:{
                    level_id : level_id
                },
                success: function(data){
                    $("#dropdown-academic-year").show();
                    $("#dropdown-academic-year").html(data);
                }
            });
        });
    });
</script>