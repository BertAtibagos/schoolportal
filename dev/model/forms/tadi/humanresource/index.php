<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/hr.css">
</head>
<body>
    <div class="card mb-3 p-3">
    <div class="row g-3 align-items-end">

        <div class="col-md-4">
            <select class="form-select">
                <option value="currCutOff">Current cut off</option>
                <option value="prevCutOff">Previous cut off</option>
                <option value="date">By date</option>
            </select>
        </div>

        <div class="col-md-4">
            <select class="form-select">
                <option value="all">All</option>
                <option value="byName">By Name</option>
                <option value="byDept">By Department</option>
            </select>
        </div>

        <div class="col-md-4 text-end">
            <button id="generateBtn" class="btn btn-primary px-4">
                Generate Report
            </button>
        </div>

    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src=""></script>