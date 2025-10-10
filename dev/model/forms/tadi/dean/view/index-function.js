function GETACADEMICLEVEL() {
  const formData = new FormData();
  formData.append('type', 'GET_ACADEMIC_LEVEL');

  fetch("tadi/dean/controller/index-info.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(result => {
      const select = document.querySelector("#academiclevel");
      select.innerHTML = result.length
        ? result.map(v => `<option value="${v.SchlAcadLvl_ID}">${v.SchlAcadLvl_NAME}</option>`).join("")
        : `<option>No Academic Level Found.</option>`;
    })
    .catch(err => console.error("Error fetching academic level:", err));
}

function GET_SUBJECT_BY_INSTRUCTOR({ SchlProf_ID }) {
  const lvlid = document.getElementById("academiclevel").value;
  const yrlvlid = document.getElementById("academicyearlevel").value;
  const prdid = document.getElementById("academicperiod").value;
  const yrid = document.getElementById("acadyear").value;

  const formData = new FormData();
  formData.append('type', 'GET_SUBJECT_BY_INSTRUCTOR');
  formData.append('prof_id', SchlProf_ID);
  formData.append('lvl_id', lvlid);
  formData.append('prd_id', prdid);
  formData.append('yr_id', yrid);
  formData.append('yrlvl_id', yrlvlid);

  const tbody = document.getElementById('subj_list');
  tbody.innerHTML = loadingRow(4);

  fetch("tadi/dean/controller/index-info.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(result => {
      displaySubjList(result);
      tbody.dataset.source = JSON.stringify(result); // Cache inside DOM instead of global var
    })
    .catch(err => console.error("Error fetching instructor subjects:", err));
}

function displaySubjList(data) {
  const tbody = document.querySelector("#subj_list");
  tbody.innerHTML = data.map((item, i) => `
    <tr>
      <td>${item.schl_sec || 'No Section'}</td>
      <td>${item.subj_code}</td>
      <td>${item.subj_desc}</td>
      <td>
        <button 
          class="btn btn-sm w-100 button-bg-change position-relative vw_tadi" 
          data-bs-target="#Instructor_Tadi_List" 
          data-bs-toggle="modal"
          data-prof-id="${item.SchlProf_ID}"
          data-suboff-id="${item.sub_off_id}"
          data-sub-desc="${item.subj_desc}"
          data-sub-sect="${item.schl_sec || 'No Section'}">
          VIEW TADI  <span class="badge bg-secondary ms-2">${item.total_count}</span>
          ${item.unverified_count > 0 ? `
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              ${item.unverified_count}
            </span>` : ''}
        </button>
      </td>
    </tr>`).join('');

  document.querySelector(".tadi_inst_name").textContent = data[0]?.prof_name || "No Instructor";

  tbody.querySelectorAll(".vw_tadi").forEach(btn => {
    btn.addEventListener("click", () => {
      const prof_id = btn.dataset.profId;
      const subj_id = btn.dataset.suboffId;
      const subj_desc = btn.dataset.subDesc;
      const subj_sect = btn.dataset.subSect;

      document.getElementById("tadi_subj_name").innerText = subj_desc;
      document.getElementById("section_name").innerText = subj_sect;

      GETALL_TADI_RECORDS(prof_id, subj_id);
    });
  });
}

function GETALL_TADI_RECORDS(prof_id, subj_id) {
  const tbody = document.getElementById('prof_tadi_list_table');
  tbody.innerHTML = loadingRow(4);

  const formData = new FormData();
  formData.append('type', 'GETALL_TADI_RECORDS');
  formData.append('prof_id', prof_id);
  formData.append('subj_off_id', subj_id);

  fetch("tadi/dean/controller/index-info.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (!data.length) {
        tbody.innerHTML = "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
        return;
      }

      tbody.innerHTML = data.map(record => {
        const activity = record.tadi_act.replace(/\\r\\n/g, "<br>");
        const viewBtn = record.tadi_filepath
          ? `<button class="btn btn-sm w-70 viewAttch" style="background-color:#2980B9;color:white" value="${record.schltadi_ID}" data-prof="${record.SchlProf_ID}">VIEW</button>`
          : `<span class="btn btn-sm w-70" style="background-color:#95A5A6;color:white;pointer-events:none;">No Attachment</span>`;

        const modeTypeMap = {
          'online_learning regular': 'Online Regular',
          'online_learning makeup': 'Online Make-Up',
          'onsite_learning regular': 'Onsite Regular',
          'onsite_learning makeup': 'Onsite Make-Up'
        };

        const status = record.tadi_status == 1
          ? `<span style="color:green;font-weight:bold;">Verified</span>`
          : `<span style="color:red;font-weight:bold;">Unverified</span>`;

        return `
          <tr>
            <td>${record.stud_name}</td>
            <td>${record.tadi_date} ${formatTimeToAmPm(record.tadi_timeIn)} - ${formatTimeToAmPm(record.tadi_timeOut)}</td>
            <td>${modeTypeMap[record.tadi_modeType] || record.tadi_modeType}</td>
            <td><span class="activity-text">${activity}</span></td>
            <td>${viewBtn}</td>
            <td>${status}</td>
          </tr>`;
      }).join('');

      tbody.querySelectorAll(".viewAttch").forEach(btn =>
        btn.addEventListener("click", e => GET_IMAGE(e.target.value, e.target.dataset.prof))
      );

      tbody.querySelectorAll(".activity-text").forEach(setupActivityText);
    })
    .catch(err => console.error("Error loading TADI records:", err));
}

function GET_IMAGE(tadi_id, prof_id) {
  const formData = new FormData();
  formData.append('type', 'GET_IMAGE');
  formData.append('tadi_id', tadi_id);
  formData.append('prof_id', prof_id);

  fetch("tadi/dean/controller/index-info.php", { method: "POST", body: formData })
    .then(res => res.json())
    .then(data => {
      if (!data || !data.tadi_filepath) {
        console.error("No image found for TADI ID", tadi_id);
        return;
      }
      const imgPrev = document.getElementById('attchPrev');
      imgPrev.src = `tadi/${data.tadi_filepath}`;
      showImageModal(data);
    })
    .catch(err => console.error("Error fetching image:", err));
}

function showImageModal(data) {
  const imgModal = new bootstrap.Modal(document.getElementById('imageModal'), { backdrop: true });
  const format = (d, t) => new Date(`${d}T${t}`).toLocaleString('en-US', {
    year: "numeric", month: "long", day: "numeric", hour: "2-digit", minute: "2-digit", hour12: true
  });

  document.getElementById('dateTimeTaken').innerText = data.exif_date ? `Taken: ${format(data.exif_date, data.exif_time)}` : 'Taken: Not Available';
  document.getElementById('dateTimeUpld').innerText = `Uploaded: ${format(data.upld_date, data.upld_time)}`;

  document.getElementById('closeModalBtn').onclick = () => {
    imgModal.hide();
    document.getElementById('attchPrev').src = '';
  };

  imgModal.show();
}

// helpers
function setupActivityText(el) {
  Object.assign(el.style, {
    display: '-webkit-box',
    WebkitLineClamp: '2',
    WebkitBoxOrient: 'vertical',
    overflow: 'hidden',
    cursor: 'pointer'
  });

  el.addEventListener('click', () => {
    const expanded = el.style.WebkitLineClamp === 'none';
    el.style.WebkitLineClamp = expanded ? '2' : 'none';
    el.style.display = expanded ? '-webkit-box' : 'block';
  });
}

function loadingRow(cols) {
  return `
    <tr>
      <td colspan="${cols}">
        <div class="text-center p-3">
          <div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>
        </div>
      </td>
    </tr>`;
}

function formatTimeToAmPm(timeString) {
  const [h, m] = timeString.split(":");
  let hour = parseInt(h, 10);
  const ampm = hour >= 12 ? "PM" : "AM";
  hour = hour % 12 || 12;
  return `${hour}:${m} ${ampm}`;
}

document.getElementById("searchSubjBtn").addEventListener("click", function() {
  let BySubjDesc = document.getElementById("BySubjDesc").value;
  let BySubjCode = document.getElementById("ByCode").value;
  let BySection = document.getElementById("BySection").value;

  if (!BySubjDesc && !BySubjCode && !BySection) {
    alert("Please enter at least one search criteria.");
    return;
  }

  // Get cached data from DOM
  const tbody = document.getElementById('subj_list');
  const cachedData = JSON.parse(tbody.dataset.source || '[]');
  
  if (!cachedData.length) {
    alert("No subject data available");
    return;
  }

  const formData = new FormData();
  formData.append('type', 'SEARCH_SUBJECT_BY_INSTRUCTOR');
  formData.append('lvlid', cachedData[0].lvlid);
  formData.append('prdid', cachedData[0].prdid);
  formData.append('yrid', cachedData[0].yrid);
  formData.append('yrlvlid', cachedData[0].yrlvlid);
  formData.append('prof_id', cachedData[0].SchlProf_ID);
  formData.append('subjDesc', BySubjDesc);
  formData.append('subjCode', BySubjCode);
  formData.append('section', BySection);

  fetch(`tadi/dean/controller/index-info.php`, {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    tbody.innerHTML = data.length ? "" : "<tr><td colspan='6' class='text-center'>No records found</td></tr>";

    data.forEach(record => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${record.schl_sec || 'No Section'}</td>
        <td>${record.subj_code}</td>
        <td>${record.subj_desc}</td>
        <td>
          <button 
            class="btn btn-sm w-100 button-bg-change position-relative vw_tadi" 
            data-bs-target="#Instructor_Tadi_List" 
            data-bs-toggle="modal"
            data-prof-id="${record.SchlProf_ID}"
            data-suboff-id="${record.sub_off_id}"
            data-sub-desc="${record.subj_desc}"
            data-sub-sect="${record.schl_sec || 'No Section'}">
            VIEW TADI  <span class="badge bg-secondary">${record.total_count || 0}</span>
            ${record.unverified_count > 0 ? `
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ${record.unverified_count}
              </span>` : ''}
          </button>
        </td>`;
      tbody.appendChild(row);
    });

    tbody.querySelectorAll(".vw_tadi").forEach(btn => {
      btn.addEventListener("click", () => {
        const prof_id = btn.dataset.profId;
        const subj_id = btn.dataset.suboffId;
        const subj_desc = btn.dataset.subDesc;
        const subj_sect = btn.dataset.subSect;

        document.getElementById("tadi_subj_name").innerText = subj_desc;
        document.getElementById("section_name").innerText = subj_sect;

        GETALL_TADI_RECORDS(prof_id, subj_id);
      });
    });
  })
  .catch(error => console.error("Error searching subjects by instructor:", error));
});