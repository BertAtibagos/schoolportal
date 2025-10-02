GET_ACADEMICLEVEL();

document.getElementById("searchButton").addEventListener("click", function () {
    const lvlid = document.getElementById("academiclevel").value;
    const yrlvlid = document.getElementById("academicYearLevel").value;
    const prdid = document.getElementById("period").value;
    const yrid = document.getElementById("acadyear").value;
    const searchQuery = document.getElementById("subjectSearch").value;

    if ((!lvlid || !yrlvlid || !prdid || !yrid) && !searchQuery) {
        alert("Please select all the filters or enter a search query before searching.");
        return;
    }
    const formData = new FormData();
    formData.append('type', 'GET_SUBJECT_LIST');
    formData.append('lvl_id', lvlid);
    formData.append('yrlvl_id', yrlvlid);
    formData.append('prd_id', prdid);
    formData.append('yr_id', yrid);
    formData.append('search', searchQuery);

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

document.getElementById('date_srch').addEventListener("click", () => {
    DISPLAY_TADI_LOG(document.getElementById('date_srch').value);
});


// document.addEventListener('DOMContentLoaded', () => {
    UPDATE_TADI_STATUS();
// });

const BASE_BACKDROP = 1050;
const BASE_MODAL = 1055;

document.addEventListener("show.bs.modal", function (e) {
    const openModals = document.querySelectorAll(".modal.show").length;

    const backdrops = document.querySelectorAll(".modal-backdrop");
    if (backdrops.length) {
        backdrops[backdrops.length - 1].style.zIndex = BASE_BACKDROP + (openModals * 20);
    }
    e.target.style.zIndex = BASE_MODAL + (openModals * 20);
});

document.addEventListener("hidden.bs.modal", function (e) {
    const openModals = document.querySelectorAll(".modal.show");
    const backdrops = document.querySelectorAll(".modal-backdrop");

    if (openModals.length > 0) {
        backdrops[backdrops.length - 1].style.zIndex = BASE_BACKDROP + ((openModals.length - 1) * 20);
        const topModal = openModals[openModals.length - 1];
        topModal.focus();
    } else {
        backdrops.forEach(b => b.remove());
    }
});