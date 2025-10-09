const spinner = `<tr class="loading-spinner hide">
                                    <td colspan="4">
                                        <div class="text-center">
                                            <div class="spinner-border " role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;

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
    const formData = new FormData();
    formData.append('type','GET_SUBJECT_LIST');

    const tbody = document.querySelector('.faculty-list');
    tbody.innerHTML = spinner;
    
    fetch("tadi/student/controller/index-info.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        displaySubjectTable(result);
    })
    .catch(err => {
        alert("Failed to load subject list. Please try again.");
        console.error("Subject List Error:", err);
    })
}

function displaySubjectTable(result) {
    const tbody = document.querySelector("#student_tadi_section tbody");
    
    tbody.innerHTML = result.map((item, index) => 
        `<tr>
            <td>${item.subj_code}</td>
            <td>${item.subj_desc}</td>
            <td>${item.prof_name || "No faculty"}</td>
            <td>
                <button 
                    class="btn btn-sm"
                    ${item.prof_name ? "" : "disabled"}
                    style="background-color: #181a46; color: white;" 
                    id="tadiModalHandler${index}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal"
                    ${item.record_count_today == 3 ? "hidden" : ""}>
                    TADI
                </button>

                <button 
                    class="btn btn-sm vw_tadi_rec"
                    style="background-color: #43dd81ff; color: white;" 
                    data-subj-id = "${item.subj_id}"
                    data-prof-id = "${item.prof_id}"
                    data-bs-toggle="modal" 
                    data-bs-target="#Instructor_Tadi_List"
                    ${item.record_count_today == 0 ? "hidden" : ""}>
                    VIEW
                </button>
            </td>
        </tr>`
    ).join("");

    result.forEach((value, index) => {
        const btn = document.getElementById(`tadiModalHandler${index}`);
        if (btn) {
            btn.addEventListener("click", () => {
                displayTadi(value); 
            });
        }
    });

    document.querySelectorAll('.vw_tadi_rec').forEach(button => {
        button.addEventListener("click", function () {
            const subj_Id = this.dataset.subjId;
            const prof_Id = this.dataset.profId;

            const params = new URLSearchParams({
                type: 'GET_SUBMITTED_REC',
                subj_Id: subj_Id,
                prof_Id: prof_Id
            });

            fetch(`tadi/student/controller/index-info.php`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: params
            })
                .then(res => res.json())
                .then(data => {
                    const navTabs = document.getElementById('nav-tab');          
                    const navTabContent = document.getElementById('nav-tabContent'); 

                    navTabs.innerHTML = '';
                    navTabContent.innerHTML = '';

                    if (!data.length) {
                        navTabContent.innerHTML = "<div class='p-3 text-center'>No records found</div>";
                        return;
                    }

                    data.forEach((record, index) => {
                        const isActive = index === 0 ? "active" : "";

                        
                        const tabBtn = document.createElement('button');
                        tabBtn.className = `nav-link ${isActive}`;
                        tabBtn.id = `nav-tab-${record.schltadi_ID}`;
                        tabBtn.setAttribute('data-bs-toggle', 'tab');
                        tabBtn.setAttribute('data-bs-target', `#tab-pane-${record.schltadi_ID}`);
                        tabBtn.type = 'button';
                        tabBtn.role = 'tab';
                        tabBtn.innerText = `Record ${index + 1}`;
                        navTabs.appendChild(tabBtn);

                        
                        const viewUploadCell = record.tadi_filepath
                            ? `<button class="btn btn-sm w-70 viewAttch" style="background-color: #2980B9; color: white" value="${record.schltadi_ID}">VIEW</button>`
                            : `<span class="btn btn-sm w-70" style="background-color: #95A5A6; color: white; pointer-events: none;">No Attachment</span>`;

                        const modeTypeMap = {
                            'online_learning regular': 'Online Regular',
                            'online_learning makeup': 'Online Make-Up',
                            'onsite_learning regular': 'Onsite Regular',
                            'onsite_learning makeup': 'Onsite Make-Up'
                        };

                        let activity = record.tadi_act.replace(/\\r\\n/g, "<br>");
                        const statusConfig = record.tadi_status == 1
                            ? { text: "Verified", color: "green" }
                            : { text: "Unverified", color: "red" };

                        const tabPane = document.createElement('div');
                        tabPane.className = `tab-pane fade show ${isActive}`;
                        tabPane.id = `tab-pane-${record.schltadi_ID}`;
                        tabPane.role = "tabpanel";
                        tabPane.setAttribute("aria-labelledby", `nav-tab-${record.schltadi_ID}`);

                        tabPane.innerHTML = `
                            <div class="p-3">
                                <div style="margin-bottom:2%">
                                    <span><span class="label">Date:</span> ${record.tadi_date}</span>
                                </div>
                                <div style="margin-bottom:2%">
                                    <span><span class="label">Time:</span> ${formatTimeToAmPm(record.tadi_timeIn)} - ${formatTimeToAmPm(record.tadi_timeOut)}</span>
                                </div>
                                <div style="margin-bottom:2%">
                                    <span><span class="label">Class Type:</span> ${modeTypeMap[record.tadi_modeType] || record.tadi_modeType}</span>
                                </div>
                                <div style="margin-bottom:2%">
                                    <span class="label">Activity:</span>
                                    <span class="activity-text" style="cursor: pointer;">${activity}</span>
                                </div>
                                <div style="margin-bottom:2%">
                                    <span><span class="label">Attachment:</span> ${viewUploadCell}</span>
                                    <input type="hidden" id="imgProf_id" value="${record.SchlProf_ID}">
                                </div>
                                <div style="margin-bottom:2%">
                                    <span class="label">Status:</span>
                                    <span class="acknw" value="${record.schltadi_ID}" name="${record.tadi_status}" 
                                    style="color:${statusConfig.color}; font-weight:bold;">${statusConfig.text}</span>
                                </div>
                            </div>
                        `;

                        navTabContent.appendChild(tabPane);

                        const text = tabPane.querySelector('.activity-text');
                        setupActivityText(text);
                    });

                    document.querySelectorAll('.viewAttch').forEach(button =>
                        button.addEventListener('click', GET_IMAGE)
                    );
                })
                .catch(err => {
                    console.error("Error loading records:", err);
                });
        });
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

    let instructor = "";
    
    if (value.prof_name && value.prof_id) {
        const profNames = value.prof_name.split(/[\/,]\s*/);
        const profIds = value.prof_id.split(/[\/,]\s*/);
        
        instructor = profNames.map((name, index) => 
            `<option value='${profIds[index]?.trim()}'>${name.trim()}</option>`
        ).join("");
    } else {
        instructor = "<option value='' selected disabled>No faculty assigned</option>";
    }

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
      imgPrev.src = `tadi/${data.tadi_filepath}`;

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