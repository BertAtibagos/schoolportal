const spinner = `<tr class="loading-spinner hide">
                                    <td colspan="4">
                                        <div class="text-center">
                                            <div class="spinner-border " role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`;
function GET_ACADEMICLEVEL() {
  fetch("tadi/prof/controller/index-info.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
      type: "GET_ACADEMIC_LEVEL"
    })
  })
  .then(res => res.json())
  .then(result => {
    let optLevel = result.length
      ? result.map(value => `<option value="${value.AcadLvl_ID}">${value.AcadLvl_Name}</option>`).join("")
      : "<option>No Academic Level Found.</option>";
    document.querySelector("#academiclevel").insertAdjacentHTML('beforeend', optLevel);
  })
  .catch(err => console.error("Error fetching academic levels:", err));

  document.querySelector("#academiclevel").addEventListener("change", function () {
    const lvlid = this.value;
    getAcademicYearLevels(lvlid);
    getAcademicPeriods(lvlid);
  });
}

function getAcademicYearLevels(lvlid) {
  fetch("tadi/prof/controller/index-info.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
      type: "GET_ACADEMIC_YEAR_LEVEL",
      lvl_id: lvlid
    })
  })
  .then(res => res.json())
  .then(result => {
    const select = document.querySelector("#academicYearLevel");
    select.innerHTML = result.length
      ? result.map(value => `<option value="${value.ACAD_YRLVL_ID}">${value.ACAD_YRLVL_NAME}</option>`).join("")
      : "<option>No Year Level Found.</option>";
  })
  .catch(err => console.error("Error fetching year levels:", err));
}

function getAcademicPeriods(lvlid) {
  fetch("tadi/prof/controller/index-info.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
      type: "GET_ACADEMIC_PERIOD",
      lvl_id: lvlid
    })
  })
  .then(res => res.json())
  .then(result => {
    const select = document.querySelector("#period");
    select.innerHTML = result.length
      ? result.map(value => `<option value="${value.acad_prd_id}">${value.acad_prd_name}</option>`).join("")
      : "<option>No Period Found.</option>";
    select.dispatchEvent(new Event("change"));
  })
  .catch(err => console.error("Error fetching periods:", err));

  document.querySelector("#period").addEventListener("change", function () {
    const lvlid = document.querySelector("#academiclevel").value;
    const prdid = this.value;
    getAcademicYears(lvlid, prdid);
  });
}

function getAcademicYears(lvlid, prdid) {
  fetch("tadi/prof/controller/index-info.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
      type: "GET_ACAD_YEAR",
      lvl_id: lvlid,
      prd_id: prdid
    })
  })
  .then(res => res.json())
  .then(result => {
    const select = document.querySelector("#acadyear");
    select.innerHTML = result.length
      ? result.map(value => `<option value="${value.Period_id}">${value.YEAR_NAME}</option>`).join("")
      : "<option>No Year Found.</option>";
  })
  .catch(err => console.error("Error fetching academic years:", err));
}

function searchTadiDataByDate(searchDate) {
  fetch("tadi/prof/controller/index-info.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
      type: "SEARCH_TADI_DATA_BY_DATE",
      search_date: searchDate
    })
  })
  .then(res => res.json())
  .then(result => {
    displaySubjectTadi(result);
  })
  .catch(error => console.error("Error performing search:", error));
}

function DISPLAY_PROFESSOR_SUBJECT(result) {

  const tableRows = result.length
    ? result.reduce((acc, value, index) => {
        acc += `
          <tr key="${value.sub_off_id}">
              <td>${value.schl_sec}</td>
              <td>${value.subj_code}</td>
              <td>${value.subj_desc}</td>
              <td class="btn_tadi">
                <button class="btn btn-sm w-100 button-bg-change position-relative viewTadi" 
                  id="viewTadiRecord${index}" 
                  data-bs-toggle="modal" 
                  data-bs-target="#sectionList" 
                  name="${value.sub_off_id}">
                  VIEW TADI
                  ${value.unverified_count > 0 ? `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">${value.unverified_count}</span>` : ''}
                </button>
              </td>
          </tr>
        `;
        return acc;
      }, "")
    : "<tr><td colspan='4'>No subjects available</td></tr>";

  document.querySelector('.prof_dashboard_table').innerHTML = tableRows;

  document.querySelectorAll('.btn_tadi').forEach(button => {
    button.addEventListener('click', function() {
      const buttonElement = this.querySelector('button');
      const sub_off_id = buttonElement.getAttribute('name');

      DISPLAYALL_TADI_RECORDS(sub_off_id);

      const tr = this.closest('tr');

      const tds = tr.querySelectorAll('td');

      const subjName = tds[2].textContent;
      const subjCode = tds[0].textContent;

      document.getElementById('subj_name').innerHTML = subjName;
      document.getElementById('subj_code').innerHTML = subjCode;
      document.getElementById('date_srch').value = sub_off_id;
    });
  });
}

function disable_acknw_bttn() {
    document.querySelectorAll('.acknw').forEach(button => {
      const status = button.getAttribute('name');
      if (status == 1) {
        let acknowledgedText = document.createTextNode('Verified');
            let span = document.createElement('span');
            span.style.color = '#198754';
            span.style.fontWeight = 'bold';
            span.appendChild(acknowledgedText);
            button.replaceWith(span);
      }
    });
}

function GET_IMAGE(event) {
  const button = event.target;
  const tadi_id = button.value;

  const formData = new FormData();
  formData.append('type', 'GET_IMAGE');
  formData.append('tadi_id', tadi_id);

  fetch('tadi/prof/controller/index-info.php', {
    method: 'POST',
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

function UPLOAD_IMAGE_PROF(){
  const tadiId = document.querySelector('.profUploadBtn').value;
  const fileInput = document.getElementById('attach');
  const file = fileInput.files[0];

   if (!file) {
    alert("Please select a file to upload.");
    return;
  }
  
  const formData =new FormData();
    formData.append("type", "UPLOAD_IMAGE_PROF");
    formData.append("tadi_id", tadiId); 
    formData.append("attach", file);
  
  fetch(`tadi/prof/controller/index-post.php`, {
          method: "POST",
          body: formData
        })
    .then(response => response.text())
    .then(text => {
      try {
        const data = JSON.parse(text);

        if (data.success) {
          alert("Uploading Successful");

        const uploadModalEl = document.getElementById('uploadModal');
        const uploadModal = bootstrap.Modal.getInstance(uploadModalEl);
        if (uploadModal) uploadModal.hide();

        const sectionListModalEl = document.getElementById('sectionList');
        const sectionListModal = bootstrap.Modal.getOrCreateInstance(sectionListModalEl);
        sectionListModal.show();

        const viewTadi = document.querySelector('.pass').value;
        DISPLAYALL_TADI_RECORDS(viewTadi);

        } else {
          alert("Upload failed: " + (data.message || "Unknown error"));
        }

      } catch (err) {
        console.error("Failed to parse JSON:", err.message);
      }
    })
    .catch(error =>{
       console.error("Error:", error);
    })
}

function UPLOAD_IMAGE_PROF_MODAL() {
   const modalEl = document.getElementById('uploadModal');
    const imageModal = new bootstrap.Modal(modalEl);
    imageModal.show();
    const upldbtnmain = document.querySelector('.upldprof').value;
    document.querySelector('.profUploadBtn').value = upldbtnmain;

    document.querySelectorAll('.profUploadBtn').forEach(button => {
      button.addEventListener('click', UPLOAD_IMAGE_PROF);
      })

  document.getElementById('uploadcloseModalBtn').onclick = function () {
    imageModal.hide();
  };
}


function DISPLAY_TADI_LOG(subj_off_id) {
  const strtDateSearch = document.getElementById('strtDateSearch').value;
  const endDateSearch = document.getElementById('endDateSearch').value;

  if (!strtDateSearch && endDateSearch) {
    alert("Please enter a start date");
    return;
  }
  if (!strtDateSearch && !endDateSearch) {
    alert("Please enter both start and end dates");
    return;
  }

  const formData = new FormData();
  formData.append('type', 'GET_TADI_RECORD');
  formData.append('strtDateSearch', strtDateSearch);
  formData.append('endDateSearch', endDateSearch);
  formData.append('subj_off_id', subj_off_id);

  const tbody = document.getElementById('rcrd_tbl_body');
  tbody.innerHTML = spinner;

  fetch('tadi/prof/controller/index-info.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      tbody.innerHTML = data.length ? "" : "<tr><td colspan='6' class='text-center'>No records found</td></tr>";

      data.forEach(record => {
        const viewUploadCell = record.tadi_filepath
          ? `<button class="btn btn-sm w-70 viewAttch" id="viewAttch${record.schltadi_ID}" value="${record.schltadi_ID}">VIEW</button>`
          : `<button class="btn btn-sm w-70 upldprof" id="upldprof${record.schltadi_ID}" value="${record.schltadi_ID}">UPLOAD</button>`;

        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${record.tadi_date}</td>
          <td>${record.stud_name}</td>
          <td>${record.tadi_mode === 'online_learning' ? 'Online' : 
                record.tadi_mode === 'onsite_learning' ? 'Onsite' : 
                record.tadi_mode}
          </td>
          <td>${record.tadi_type}</td>
          <td>${new Date('1970-01-01T' + record.tadi_timein).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })} - 
              ${new Date('1970-01-01T' + record.tadi_timeout).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })}</td>
          <td>
            ${viewUploadCell}
            <input type="hidden" class="pass" id="pass${record.sub_off_id}" value="${record.sub_off_id}">
          </td>
          <td>
            <button class="btn acknw btn-success" value="${record.schltadi_ID}" name="${record.tadi_status}">Verify</button>
          </td>
        `;
        tbody.appendChild(row);
      });

      document.querySelectorAll('.viewAttch').forEach(button => {
        button.addEventListener('click', GET_IMAGE);
      });

      document.querySelectorAll('.upldprof').forEach(button => {
        button.addEventListener('click', UPLOAD_IMAGE_PROF_MODAL);
      });

      disable_acknw_bttn();
    })
    .catch(error => console.error('Error fetching data:', error));
}

function DISPLAYALL_TADI_RECORDS(subj_off_id) {
  const formData = new FormData();
  formData.append('type', 'GETALL_TADI_RECORD');
  formData.append('subj_off_id', subj_off_id);

  let tbody = document.getElementById('rcrd_tbl_body');
  tbody.innerHTML = spinner;

  fetch('tadi/prof/controller/index-info.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    
    tbody.innerHTML = data.length ? "" : "<tr><td colspan='6' class='text-center'>No records found</td></tr>";

    for (let record of data) {
      let viewUploadCell = '';
      if (record.tadi_filepath) {
        viewUploadCell = `<button class="btn btn-sm btn-secondary w-70 viewAttch" id="viewAttch${record.schltadi_ID}" value="${record.schltadi_ID}">VIEW</button>`;
      } else {
        viewUploadCell = `<button class="btn btn-sm btn-dark w-70 upldprof" id="upldprof${record.schltadi_ID}" value="${record.schltadi_ID}">UPLOAD</button>`;
      }

      let row = document.createElement('tr');
      row.innerHTML = `
        <td>${record.tadi_date}</td>
        <td>${record.stud_name}</td>
        <td>${record.tadi_mode === 'online_learning' ? 'Online' : 
             record.tadi_mode === 'onsite_learning' ? 'Onsite' : 
             record.tadi_mode}</td>
        <td>${record.tadi_type}</td>
        <td>${new Date('1970-01-01T' + record.tadi_timein).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })} - 
            ${new Date('1970-01-01T' + record.tadi_timeout).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })}</td>
        <td>
          ${viewUploadCell}
          <input type="hidden" class="pass" id="pass${record.sub_off_id}" value="${record.sub_off_id}">
        </td>
        <td>
          <button class="btn acknw btn-success" value="${record.schltadi_ID}" name="${record.tadi_status}">Verify</button>
          <input type="hidden" class="pass" id="pass${record.sub_off_id}" value="${record.sub_off_id}">
        </td>
      `;

      tbody.appendChild(row);
    }

    disable_acknw_bttn();

    document.querySelectorAll('.viewAttch').forEach(button => {
      button.addEventListener('click', GET_IMAGE);
    });

    document.querySelectorAll('.upldprof').forEach(button => {
      button.addEventListener('click', UPLOAD_IMAGE_PROF_MODAL);
    });
  })
  .catch(error => console.error('Error fetching data:', error));
}


function attachSubjectClickHandlers(results) {
  results.forEach((value, index) => {
    const button = document.getElementById(`viewTadiRecord${index}`);
    if (button){
      button.addEventListener("click", () => {
        const sub_off_id = button.getAttribute("name");
        getSectionList(sub_off_id);
        displayModalHeader(value);

        const modal = new bootstrap.Modal(document.getElementById("sectionList"));
        modal.show();
      });
    }
  });
}



function UPDATE_TADI_STATUS() {
  let isInitialized = false;
  
  if (isInitialized) return;
  
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('acknw')) {
      const button = e.target;
      if (!confirm('Are you sure you want to verify this record?')) {
        return;
      }
      button.disabled = true;
      
      const status = button.getAttribute('name');
      const tadiId = button.value;
      
      const hiddenInput = document.querySelector('.pass');
      const subOffId = hiddenInput ? hiddenInput.value : null;
      
      fetch(`tadi/prof/controller/index-post.php`, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          type: "UPDATE_TADI_STATUS", 
          tadi_status: status,
          tadi_ID: tadiId
        })
      })
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        let acknowledgedText = document.createTextNode('Verified');
        let span = document.createElement('span');
        span.style.color = '#198754';
        span.style.fontWeight = 'bold';
        span.appendChild(acknowledgedText);
        button.replaceWith(span);

        if (subOffId) {
          fetch("tadi/prof/controller/index-post.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
              type: "GET_UNVERIFIED_COUNT",
              sub_off_id: subOffId
            })
          })
          .then(res => res.json())
          .then(result => {

            const mainTableButton = document.querySelector(`button[name="${subOffId}"]`);
            if (mainTableButton) {
              const badge = mainTableButton.querySelector('.badge');
              if (result.unverified_count > 0) {
                if (badge) {
                  badge.textContent = result.unverified_count;
                } else {
                  const newBadge = document.createElement('span');
                  newBadge.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                  newBadge.textContent = result.unverified_count;
                  mainTableButton.appendChild(newBadge);
                }
              } else if (badge) {
                badge.remove();
              }
            }
          })
          .catch(err => console.error("Error updating unverified count:", err));
        }
      })
      .catch(error => {
        console.error("Error:", error);
        button.disabled = false;
        alert("Failed to verify: " + error.message);
      });
    }
  });
  isInitialized = true;
}



