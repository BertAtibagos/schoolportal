<style>
    #section-surveymonitoring {
        padding-bottom: 5rem;
    }
</style>

<section id="section-surveymonitoring">
    <div id="div-surveymonitoring">
        <div class='col-2'>
                <select id='form' class='form-control form' style='text-align:left; font-size:12px;' required>
                    <option value="survey" name="Surv">SURVEY</option>
                    <option value="evaluation" name="Eval">EVALUATION</option>
                </select>
        </div>
        <div class='row my-4'>
            <div class='col-2'>
                <select id='acadlevel' class='form-control acadlevel' style='text-align:left; font-size:12px;' required>
                </select>
            </div>
            <div class='col-2'>
                <select id='acadyear' class='form-control acadyear' style='text-align:left; font-size:12px;' required>
                </select>
            </div>
            <div class='col-2'>
                <select id='acadperiod' class='form-control acadperiod' style='text-align:left; font-size:12px;' required>
                </select>
            </div>
            <div class='col-4'>
                <select id='formname' class='form-control formname' style='text-align:left; font-size:12px;' required>
                </select>
            </div>
            <div class='col-2'>
                <button id='btnSearchForm' class='btn btn-primary' style='text-align:left; font-size:12px;'> Search </button>
            </div>
        </div>
        <hr>
    </div>
    <div id="search_result" style="display: none;">
        <div id="table-container" class="my-4">
            <form method="POST" id="convert_form" action="surveymonitoring/export.php">
                <button type="button" name="convert" id="convert" class="btn btn-success mb-4 d-none">Convert to Excel</button>
                <table class="table-bordered" id="table_content" style="display: block; border-collapse: collapse;">
                </table>
                <input type="hidden" name="file_content" id="file_content">
          
            </form>
        </div>
    </div>
</section>
<script src="../../js/custom/surveymonitoring-script.js"></script>