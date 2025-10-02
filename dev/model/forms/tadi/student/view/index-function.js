function GET_SCHOOLYEAR() {

    const formData = new FormData();
    formData.append('type','GET_SCHOOL_YEAR');
    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        let optYEAR = result.map(value =>
            `<option value='${value.AcadYr_ID}'>${value.AcadYr_Name}</option>`
        ).join("");

        document.getElementById("academicSchoolYear").innerHTML = optYEAR || "<option></option>";
    })
    .catch(err => console.error("School Year Fetch Error:", err));
}

function GET_ACADEMICPERIOD(){

    const formData = new FormData();
    formData.append('type','GET_ACADEMIC_PRD');

    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        let optPRD = result.map(value =>
            `<option value='${value.Period_ID}'>${value.Period_Name}</option>`
        ).join("");

        document.getElementById("period").innerHTML = optPRD || "<option></option>";
    })
    .catch(err => console.error("Academic Period Fetch Error:", err));
}

function GET_YEARLEVEL() {

    const formData = new FormData();
    formData.append('type','GET_YEAR_LEVEL');

    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        let optYrLvl = result.map(value =>
            `<option value='${value.Yrlvl_ID}'>${value.Yrlvl_Name}</option>`
        ).join("");

        document.getElementById("academicYearLevel").innerHTML = optYrLvl || "<option></option>";
    })
    .catch(err => console.error("Year Level Fetch Error:", err));
}

function GET_ACADEMICLEVEL() {

    const formData = new FormData();
    formData.append('type','GET_ACADEMIC_LEVEL');

    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        let optAcadLvl = result.map(value =>
            `<option value='${value.AcadLvl_ID}'>${value.AcadLvl_Name}</option>`
        ).join("");

        document.getElementById("academicLevel").innerHTML = optAcadLvl || "<option></option>";

        document.getElementById("classEndDateTime").addEventListener("change", function () {
            const start = document.getElementById("classStartDateTime").value;
            const end = this.value;

            if (start && end && end <= start) {
                this.classList.add("is-invalid");
                this.nextElementSibling.textContent = "Class end time must be later than start time";
                this.value = "";
            } else {
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("modal").addEventListener("hidden.bs.modal", function () {
            document.getElementById("tadiForm").reset();
        });
    })
    .catch(err => console.error("Academic Level Fetch Error:", err));
}

function GET_SUBJECTLIST() {
    document.getElementById("loadingSpinner").style.display = "block";
    const formData = new FormData();
    formData.append('type','GET_SUBJECT_LIST');

    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        document.getElementById("loadingSpinner").style.display = "none";
        displaySubjectTable(result);
    })
    .catch(err => {
        document.getElementById("loadingSpinner").style.display = "none";
        alert("Failed to load subject list. Please try again.");
        console.error("Subject List Error:", err);
    });
}

function displaySubjectTable(result) {
    const tbody = document.querySelector("#TadiStudentTadi tbody");
    
    tbody.innerHTML = result.map((item, index) => `
        <tr>
            <td>${item.subj_code}</td>
            <td>${item.subj_desc}</td>
            <td>${item.prof_name || "No instructor"}</td>
            <td>
                <button 
                    class="btn btn-sm w-100"
                    ${item.prof_name ? "" : "disabled"} 
                    style="background-color: #181a46; color: white;" 
                    id="tadiModalHandler${index}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal">
                    TADI
                </button>
            </td>
        </tr>
    `).join("");

    result.forEach((value, index) => {
        const btn = document.getElementById(`tadiModalHandler${index}`);
        if (btn) {
            btn.addEventListener("click", () => {
                displayTadi(value); 
            });
        }
    });
}

function displayTadi(value) {
    const formattedDate = new Date().toLocaleDateString("en-PH", {
        month: "long",
        day: "numeric",
        year: "numeric",
    });

    document.getElementById("subjoff_id").value = value.subj_id;
    document.getElementById("tadi_modal_label").textContent = value.subj_desc;
    document.getElementById("subject_details").textContent = `Course Code: ${value.subj_code}`;
    document.getElementById("date_now").textContent = formattedDate;

    const instructor = value.prof_name
        ? `<option value='${value.prof_id}'>${value.prof_name}</option>`
        : "<option value='' selected disabled>No instructor assigned</option>";
    document.getElementById("instructor").innerHTML = instructor;
}

function GET_IMAGE(event) {
  const button = event.target;
  const tadi_id = button.value;
  const prof_id = document.getElementById("imgProf_id").value;

  const formData = new FormData();
  formData.append('type','GET_IMAGE');
  formData.append('tadi_id',tadi_id);
  formData.append('prof_id', prof_id);

  fetch(`tadi/student/controller/index-info.php`,{
    method: "POST",
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data && data.tadi_filepath) {
      const imgPrev = document.getElementById('attchPrev');
      imgPrev.src = `${window.location.origin}/TADI-FCPC/${data.tadi_filepath}`;

      const dateTimeUpldStr = `${data.upld_date}T${data.upld_time}`;
      const upldObj = new Date(dateTimeUpldStr);

      const optionsFullDate = { year: "numeric", month: "long", day: "numeric" };

      let takenText = "Not Available";
      if (data.exif_date && data.exif_time) {
        const dateTimeTakenStr = `${data.exif_date}T${data.exif_time}`;
        const takenObj = new Date(dateTimeTakenStr);
        const formatTakenDate = takenObj.toLocaleDateString("en-US", optionsFullDate);
        const formatTakenTime = takenObj.toLocaleTimeString("en-US", { hour: "2-digit", minute: "2-digit", hour12: true });
        takenText = formatTakenDate + " " + formatTakenTime;
      }

      const formatUpldDate = upldObj.toLocaleDateString("en-US", optionsFullDate);
      const formatUpldTime = upldObj.toLocaleTimeString("en-US", { hour: "2-digit", minute: "2-digit", hour12: true });

      const imgexDateTimeTaken = document.getElementById('dateTimeTaken');
      const imgDateTimeUpld = document.getElementById('dateTimeUpld');

      imgexDateTimeTaken.innerText = "Taken: " + takenText;
      imgDateTimeUpld.innerText = "Uploaded: " + formatUpldDate + " " + formatUpldTime;

      const imgModalEl = document.getElementById('imageModal');
      const imgModal = new bootstrap.Modal(imgModalEl, {
        backdrop: true
      });

      imgModal.show();

      const closeBtn = document.getElementById('closeModalBtn');
      closeBtn.onclick = function () {
        imgModal.hide();
        imgPrev.src = '';
      };
    } else {
      console.error("No image found for the given TADI ID.");
    }
  })
  .catch(err => console.error("Error fetching image:", err));
}

function formatTimeToAmPm(timeString) {
  const [hours, minutes] = timeString.split(":");
  let hoursInt = parseInt(hours, 10);
  const period = hoursInt >= 12 ? "PM" : "AM";
  hoursInt = hoursInt % 12 || 12;
  return `${hoursInt}:${minutes} ${period}`;
}

function setupActivityText(element) {
  const initialStyle = {
    display: '-webkit-box',
    webkitLineClamp: '2',
    webkitBoxOrient: 'vertical',
    overflow: 'hidden'
  };

  Object.assign(element.style, initialStyle);
  
  element.addEventListener('click', function() {
    const isCollapsed = this.style.display === '-webkit-box';
    this.style.display = isCollapsed ? 'block' : '-webkit-box';
    this.style.webkitLineClamp = isCollapsed ? 'none' : '2';
  });
}