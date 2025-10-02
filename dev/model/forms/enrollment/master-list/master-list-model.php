<?php
    // Before session_start()
    ini_set('session.cookie_httponly', 1); // Prevent JavaScript access
    ini_set('session.cookie_secure', 1);    // Send cookie only over HTTPS
    ini_set('session.cookie_samesite', 'Strict'); // Optional: prevent CSRF

    // if(empty($_GET['token']) && !isValidToken($_GET['token'])){
    //     http_response_code(404);
    //     exit;
    // }

    // PHP error handling
    // ini_set('display_errors', 0);
    // ini_set('log_errors', 1);

	session_start();
	require_once '../../../configuration/connection-config.php';

    // === 1. Check if employee is dean or under that department ===
    $id = $_SESSION['USERID'];

    if (!isset($_SESSION['USERID']) || $_SESSION['USERTYPE'] !== 'EMPLOYEE'){
        exit('Access Denied.');
    }

    $stmt = $dbConn->prepare("SELECT DISTINCT dept.`SchlDeptSms_ID` FROM `schoolemployee` emp

        LEFT JOIN `schooldepartment` dept
        ON emp.`SchlDept_ID` = dept.`SchlDeptSms_ID`

        WHERE emp.`SchlEmp_STATUS` = 1
        AND emp.`SchlEmp_ISACTIVE` = 1
        AND dept.`SchlDept_ISACTIVE` = 1
        AND dept.`SchlDept_STATUS` = 1
        AND dept.`SchlDeptHead_ID` = ?");
    
    $stmt->bind_param('s', $id);
    $stmt->execute();
            
    $stmt->bind_result($deptid);
    if (!$stmt->fetch()) {
        exit('Access Denied.');
    }

    $stmt->close();
    $_SESSION['USERDEPT'] = $deptid;
    // echo $deptid;


?>

<section class="m-auto" style="width: 95%; padding-bottom: 5rem;">
    <div id="errormessage"></div>
    <div class="row">
        <div class='col-lg-2 my-2'>
            <select id='acadlevel' name='acadlevel' class='form-select'>
            </select>
        </div>
        <div class='col-lg-2 my-2'>
            <select id='acadyear' name='acadyear' class='form-select'>
            </select>
        </div>
        <div class='col-lg-2 my-2'>
            <select id='acadperiod' name='acadperiod' class='form-select'>
            </select>
        </div>
    </div>
    <div class="row">
        <div class='col-lg-6 my-2'>
            <select id='acadcourse' name='acadcourse' class='form-select'>
            </select>
        </div>
    </div>
    <div class="row">
        <div class='col-lg-2 my-2'>
            <select id='acadyearlevel' name='acadyearlevel' class='form-select'>
            </select>
        </div>
        <div class='col-lg-2 my-2'>
            <select id='acadsection' name='acadsection' class='form-select'>
            </select>
        </div>
    </div>
    <div class="row">
        <div class='col-lg-4 my-2'>
            <input type="text" id='acadinfotext' name='acadinfotext' class='form-control'>
        </div>
        <div class='col-lg-2 my-2'>
            <select id='acadinfotype' name='acadinfotype' class='form-select'>
                <option value="last name">Last Name</option>
                <option value="first name">First Name</option>
            </select>
        </div>
        <div class='col-lg-2 my-2'>
            <button id='btnSearch' name='btnSearch' class='btn btn-primary'> Search </button>
        </div>
    </div>

    <hr>
    <style>
        #userTable thead tr th {
            position: sticky;
            top: -2px;
            z-index: 1; /* Ensures header stays on top */
            background-color: #c2dbfe;
            color: #071976;
        }

        #divTableContainer {
            max-height: 50vh;
            overflow-y: auto;
        }
    </style>
    <div id="divStudentTable">
        <!-- SEARCH RESULT TABLE -->
        <div>
            <caption>Total: <span id="tableRowCount">0 enrolled students</span></caption>
        </div>
        <div id="divTableContainer">
            <table class="table table-hover table-responsive-lg caption-top" id="userTable">
                <thead class="table-primary bg-opacity-25">
                    <th class="ps-4" style='width: 2rem'>#</th>
                    <th class='ps-4' style='width: 15%'>Student Number</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Gender</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </thead>
                <tbody class="table-group-divider">
                    <tr><td colspan="99" class="text-center text-danger" style="font-weight: 500">No matching records yet</td></tr>
                </tbody>

            </table>
        </div>

    </div>
</section>
<script src="../../js/custom/master-list-script.js?t=<?php echo time(); ?>"></script>