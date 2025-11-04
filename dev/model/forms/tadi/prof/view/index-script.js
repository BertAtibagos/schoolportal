GET_ACADEMICLEVEL();

document.getElementById("searchButton").addEventListener("click", function () {
    const lvlid = document.getElementById("academiclevel").value;
    const yrlvlid = document.getElementById("academicYearLevel").value;
    const prdid = document.getElementById("period").value;
    const yrid = document.getElementById("acadyear").value;
    const searchQuery = document.getElementById("subjectSearch").value;

    const dashBoardReturn = document.getElementById('summaryTadiBtn');
    dashBoardReturn.style.display = 'block';
    
    if ((!lvlid || !yrlvlid || !prdid || !yrid) && !searchQuery) {
        showAlertModal("Please select all the filters or enter a Subject Code before searching.");
         emptyCriteriaReport();
        return;
    }else{
        resetCriteriaReport();
    }

    const formData = new FormData();
    formData.append('type', 'GET_SUBJECT_LIST');
    formData.append('lvl_id', lvlid);
    formData.append('yrlvl_id', yrlvlid);
    formData.append('prd_id', prdid);
    formData.append('yr_id', yrid);
    formData.append('search', searchQuery);

    const tbodySpinner = document.querySelector('.prof_dashboard_table');
    tbodySpinner.innerHTML =`<tr class="loading-spinner hide">
                                    <td colspan="4">
                                        <div class="text-center">
                                            <div class="spinner-border " role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;

    const thead = document.getElementById('theadTable');
    thead.innerHTML = '';
    thead.innerHTML = `<tr id="searchResultHeader" >
                        <th scope="col" style="background-color: #181a46; color: white;">Section</th>
                        <th scope="col" style="background-color: #181a46; color: white;">Subject Code</th>
                        <th scope="col" style="background-color: #181a46; color: white;">Description</th>
                        <th scope="col" style="background-color: #181a46; color: white;"></th>
                    </tr>`;
document.querySelector('.legend').style.display = 'block';

        const summary = document.querySelector('.summary');
        const tableWrapper = document.querySelector('.inst_list_tbl_wrapper');
        tableWrapper.classList.remove('dashboard');
        summary.classList.add("summary-hide");
        document.getElementById('summaryId').style.display = 'none';

    fetch('tadi/prof/controller/index-info.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then((result) => {
        DISPLAY_PROFESSOR_SUBJECT(result);
    })
    .catch((err) => console.error("Fetch error:", err));
});

document.getElementById("subjectSearch").addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        document.getElementById("searchButton").click();
    }
});

document.querySelectorAll('.button-bg-change').forEach(btn => {
    btn.addEventListener("click", DISPLAYALL_TADI_RECORDS);
});

document.getElementById('date_srch').addEventListener("click", function(){
    const summary = this.getAttribute('data-summary');
    console.log("data summary status:", summary);
    DISPLAY_TADI_LOG(this.value, summary);
});

UPDATE_TADI_STATUS();

document.addEventListener("show.bs.modal", function (e) {
    const openModals = document.querySelectorAll(".modal.show").length;

    const backdrops = document.querySelectorAll(".modal-backdrop");
    if (backdrops.length) {
        backdrops[backdrops.length - 1].style.zIndex = 1050 + (openModals * 20);
    }
    e.target.style.zIndex = 1055 + (openModals * 20);
});

document.addEventListener("hidden.bs.modal", function (e) {
    const openModals = document.querySelectorAll(".modal.show");
    const backdrops = document.querySelectorAll(".modal-backdrop");

    if (openModals.length > 0) {
        backdrops[backdrops.length - 1].style.zIndex = 1050 + ((openModals.length - 1) * 20);
        const topModal = openModals[openModals.length - 1];
        topModal.focus();
    } else {
        backdrops.forEach(b => b.remove());
    }
});

function showAlertModal(message) {
  const modalEl = document.getElementById('alertModal');
  const modalBody = document.getElementById('alertModalBody');
  modalBody.textContent = message;
  const modal = new bootstrap.Modal(modalEl);
  modal.show();
}

function emptyCriteriaReport(){
    const academiclevel = document.getElementById('academiclevel');
    const academicyearlevel = document.getElementById('academicYearLevel');
    const academicperiod = document.getElementById('period');
    const acadyear = document.getElementById('acadyear');
    const subjCode = document.getElementById('subjectSearch');

    academiclevel.classList.remove("border-dark");
    academiclevel.classList.add("border-danger");
    academiclevel.classList.add("is-invalid");

    academicyearlevel.classList.remove("border-dark");
    academicyearlevel.classList.add("border-danger");
    academicyearlevel.classList.add("is-invalid");

    academicperiod.classList.remove("border-dark");
    academicperiod.classList.add("border-danger");
    academicperiod.classList.add("is-invalid");

    acadyear.classList.remove("border-dark");
    acadyear.classList.add("border-danger");
    acadyear.classList.add("is-invalid");

    subjCode.classList.remove("border-dark");
    subjCode.classList.add("border-danger");
    subjCode.classList.add("is-invalid");
}

function resetCriteriaReport(){
    const academiclevel = document.getElementById('academiclevel');
    const academicyearlevel = document.getElementById('academicYearLevel');
    const academicperiod = document.getElementById('period');
    const acadyear = document.getElementById('acadyear');
    const subjCode = document.getElementById('subjectSearch');

    academiclevel.classList.remove("border-danger");
    academiclevel.classList.remove("is-invalid");
    academiclevel.classList.add("border-dark");
    
    academicyearlevel.classList.remove("border-danger");
    academicyearlevel.classList.remove("is-invalid");
    academicyearlevel.classList.add("border-dark");

    academicperiod.classList.remove("border-danger");
    academicperiod.classList.remove("is-invalid");
    academicperiod.classList.add("border-dark");

    acadyear.classList.remove("border-danger");
    acadyear.classList.remove("is-invalid");
    acadyear.classList.add("border-dark");

    subjCode.classList.remove("border-danger");
    subjCode.classList.remove("is-invalid");
    subjCode.classList.add("border-dark");
}

function invalidStartDateInput(){
    const startDate = document.getElementById("strtDateSearch");
      startDate.classList.remove("border-dark");
      startDate.classList.add("border-danger");
      startDate.classList.add("is-invalid");
}

function invalidEndDateInput(){
    const endDate = document.getElementById("endDateSearch");
      endDate.classList.remove("border-dark");
      endDate.classList.add("border-danger");
      endDate.classList.add("is-invalid");
}

function resetStartEndDateInput(){
    const startDate = document.getElementById("strtDateSearch");
    const endDate = document.getElementById("endDateSearch");

      startDate.classList.add("border-dark");
      startDate.classList.remove("border-danger");
      startDate.classList.remove("is-invalid");

      endDate.classList.add("border-dark");
      endDate.classList.remove("border-danger");
      endDate.classList.remove("is-invalid");
}

function displaySummary(){
    const thead = document.getElementById('theadTable');
    const summaryCard = document.querySelector('.summary');

    summaryCard.classList.remove("summary-hide");
    document.querySelector('.inst_list_tbl_wrapper').classList.add("dashboard");
    thead.innerHTML = '';
    thead.innerHTML = `<tr id="defaultHeader">
                            <th scope="col" style="background-color: #181a46; color: white;">Section</th>
                            <th scope="col" style="background-color: #181a46; color: white;">Subject</th>
                            <th scope="col" style="background-color: #181a46; color: white;">Total Records</th>
                            <th scope="col" style="background-color: #181a46; color: white;">Unverified Records</th>
                            <th scope="col" style="background-color: #181a46; color: white;"></th>
                        </tr>`;
    document.querySelector('.legend').style.display = 'none';
    tadiSummary();
}