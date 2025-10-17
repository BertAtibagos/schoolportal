GETACADEMICLEVEL();

document.querySelector(".subj-table").style.display = "none";
document.querySelector(".instr-table").style.display = "block";

// document.getElementById("type").addEventListener("change", function () {
//     const optionValue = this.value;

//     document.querySelectorAll(".box").forEach(box => {
//         box.style.display = "none";
//     });

//     if (optionValue === "instructor") {
//         document.querySelector(".instr-table").style.display = "block";
//     } else if (optionValue === "subject") {
//         document.querySelector(".subj-table").style.display = "block";
//     }
// });

document.getElementById("academiclevel").addEventListener("change", function () {
    const lvlid = this.value;

    const formData = new FormData();
    formData.append('type', 'GET_ACADEMIC_YEAR_LEVEL');
    formData.append('lvl_id', lvlid)

    fetch(`tadi/dean/controller/index-info.php`, {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(result => {
            let optYearLevel = result.length
                ? result.map(value => `<option value="${value.ACAD_YRLVL_ID}">${value.ACAD_YRLVL_NAME}</option>`).join("")
                : "<option>No Year Level Found.</option>";
            document.getElementById("academicyearlevel").innerHTML = optYearLevel;
        });

    const formData1 = new FormData();
    formData1.append('type', 'GET_ACADEMIC_PERIOD');
    formData1.append('lvl_id', lvlid);

    fetch(`tadi/dean/controller/index-info.php`, {
        method: "POST",
        body: formData1
    })
        .then(res => res.json())
        .then(result => {
            let optPeriod = result.length
                ? result.map(value => `<option value="${value.acad_prd_id}">${value.acad_prd_name}</option>`).join("")
                : "<option>No Period Found.</option>";
            document.getElementById("academicperiod").innerHTML = optPeriod;

            document.getElementById("academicperiod").dispatchEvent(new Event("change"));
        });
});

document.getElementById("academicperiod").addEventListener("change", function () {
    const lvlid = document.getElementById("academiclevel").value;
    const prdid = this.value;

    const formData = new FormData();
    formData.append('type', 'GET_ACAD_YEAR');
    formData.append('lvl_id', lvlid);
    formData.append('prd_id', prdid)

    fetch(`tadi/dean/controller/index-info.php`, {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(result => {
            let optYear = result.length
                ? result.map(value => `<option value="${value.SchlAcadYrSms_ID}">${value.YEAR_NAME}</option>`).join("")
                : "<option>No Year Found.</option>";
            document.getElementById("acadyear").innerHTML = optYear;
        });
});

document.getElementById("search_button").addEventListener("click", function () {
    const lvlid = document.getElementById("academiclevel").value;
    const yrlvlid = document.getElementById("academicyearlevel").value;
    const prdid = document.getElementById("academicperiod").value;
    const yrid = document.getElementById("acadyear").value;

    const formData1 = new FormData();
    formData1.append('type', 'GET_INSTRUCTOR_LIST');
    formData1.append('lvl_id', lvlid);
    formData1.append('prd_id', prdid);
    formData1.append('yr_id', yrid);
    formData1.append('yrlvl_id', yrlvlid);

    const tbodySpinner = document.getElementById('instructor');
    tbodySpinner.innerHTML =`<tr class="loading-spinner hide">
                                    <td colspan="4">
                                        <div class="text-center">
                                            <div class="spinner-border " role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;

    fetch(`tadi/dean/controller/index-info.php`, {
        method: "POST",
        body: formData1
    })
        .then(res => res.json())
        .then(result => {
            const tableRows = result.length
                ? result.map((item, index) => `
                    <tr class="inst_name" key="${item.subj_id}">
                        <td>${item.prof_name ? item.prof_name : "No instructor"}</td>
                        <td class="col-2 text-center">
                            <button class="btn btn-sm justify-content-md-center w-75 button-bg-change position-relative" ${item.prof_name ? "" : "disabled"} id="instructorModalHandler${index}" data-bs-toggle="modal" data-bs-target="#Instructor_Subject_List">
                            SECTION LIST
                            ${item.unverified_count > 0 ? `<span class="position-absolute top-0 start-100 translate-middle  p-2 bg-danger border border-light rounded-circle"></span>` : ''}
                            </button>
                        </td>
                    </tr>
                `).join("")
                : `<tr>
                    <td colspan="5" class="text-center">No data available</td>
                    </tr>`;

            document.getElementById("instructor").innerHTML = tableRows;

            result.forEach((value, index) => {
                document.getElementById(`instructorModalHandler${index}`)?.addEventListener("click", function () {
                    GET_SUBJECT_BY_INSTRUCTOR(value);
                });
            });
        });
});

// Add to your existing search button handler
document.getElementById("exportBtn").addEventListener("click", function() {
    document.querySelector(".instr-table").style.display = "none";
    document.getElementById("tadiBtn").style.display = "block";
    document.getElementById("exportBtn").style.display = "none";
    document.getElementById("search_button").style.display = "none";
    document.getElementById("reportSearch").style.display = "block";

    const repCont = document.getElementById("reportContainer");
    repCont.style.display = "block";
    repCont.innerHTML = `<div style="text-align: center;">
                            <p>Select all filters above and click "Generate Report" to generate report.</p>
                            <p>The start date and end date can be blank.</p>
                        </div>`;
    document.getElementById("tadiTitle").innerText = "TADI Report";

    document.querySelector(".export-header").style.display = "block";
    document.querySelector(".report-container").style.display = "block";

    document.querySelectorAll(".date-range-xport").forEach(element => {
        element.style.display = "block";
    });

});

document.getElementById("tadiBtn").addEventListener("click", function() {
    document.querySelector(".instr-table").style.display = "block";
    document.getElementById("tadiBtn").style.display = "none";
    document.querySelector(".export-content").innerHTML = '';
    document.getElementById("exportBtn").style.display = "block";
    document.getElementById("search_button").style.display = "block";
    document.getElementById("reportSearch").style.display = "none";
    const start_date = document.getElementById("startDate");
    const end_date = document.getElementById("endDate");
    start_date.type = "text";
    end_date.type = "text";
    end_date.value = "";

    const repCont = document.getElementById("reportContainer");
    repCont.innerHTML = `<div style="text-align: center;">
                            <p>Select all filters above and click "Generate Report" to generate report.</p>
                            <p>The start date and end date can be blank.</p>
                        </div>`;
    repCont.style.display = "none";
    
    document.getElementById("tadiTitle").innerText = "TADI - Dean";


    document.querySelector(".export-header").style.display = "none";
    document.querySelector(".report-container").style.display = "none";

    document.querySelectorAll(".date-range-xport").forEach(element=>{
        element.style.display = "none";
    })
});

document.getElementById("startDate").addEventListener("focus", function(){
    this.type = "date";
});

document.getElementById("endDate").addEventListener("focus", function(){
    this.type = "date";
    const date = new Date().toLocaleDateString('en-CA');
    this.value = date;
});

