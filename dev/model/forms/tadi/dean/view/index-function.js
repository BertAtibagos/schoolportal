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


document.getElementById("reportSearch").addEventListener("click", function(){

  document.querySelector(".export-content").innerHTML = '';
  
  const lvlid = document.getElementById("academiclevel").value;
  const yrlvlid = document.getElementById("academicyearlevel").value;
  const prdid = document.getElementById("academicperiod").value;
  const yrid = document.getElementById("acadyear").value;
  const startDate = document.getElementById("startDate").value;
  const endDate = document.getElementById("endDate").value;

  if(!lvlid || !yrlvlid || !prdid || !yrid){
    alert("Please select all filters to generate the report");
    return;
  }

  const formData = new FormData();
  formData.append('type', 'GET_TEACHER_TADI_REPORT');
  formData.append('lvl_id', lvlid);
  formData.append('prd_id', prdid);
  formData.append('yr_id', yrid);
  formData.append('yrlvl_id', yrlvlid);

  let lvl = null;
  let yrlvl = null;
  let prd = null;
  
  switch(lvlid){
    case '1':
      lvl = "Basic Education";
      break;
    case '2':
      lvl = "Tertiary";
      break;
    case '3':
      lvl = "Graduate School";
      break;
      default:
        lvl = null;
  }

  switch(yrlvlid){
    case '6':
      yrlvl = "1st Year";
      break;
    case '7':
      yrlvl = "2nd Year";
      break;
    case '8':
      yrlvl = "3rd Year";
      break;
    case '9':
      yrlvl = "4th Year";
      break;
    default:
      yrlvl = null;
  }

  switch(prdid){
    case '5':
      prd = "1st Semester";
      break;
    case '6':
      prd = "2nd Semester";
      break;
    case '7':
      prd = "Mid Year";
      break;
    default:
      prd = null;
  }

  let headerLabel = `${lvl} ${yrlvl} - ${prd}`;
  let exprtname = `TADI-REPORT-${lvl.toUpperCase()}-${yrlvl.toUpperCase()}-${prd.toUpperCase()}`;

  if(startDate && endDate){
    formData.append('startDate', startDate);
    formData.append('endDate', endDate);
    headerLabel = `${headerLabel} (${startDate} to ${endDate})`; 
    exprtname = `${exprtname}-(${startDate}-TO-${endDate})`;
    
    if(startDate > endDate){
      alert("Start date must be earlier than end date.");
      return;
    };
  };

  if(!startDate && endDate){
    alert("Please select a start date.");
    return;
  }else if(startDate && !endDate){
    alert("Please select an end date.");
    return;
  };

  const reportContainer = document.getElementById('reportContainer');
  reportContainer.innerHTML = loadingRow(4);

  const repBtn = document.getElementById("reportSearch");
  const backTadi = document.getElementById("tadiBtn");
  repBtn.disabled = true;
  backTadi.disabled = true;

  fetch("tadi/dean/controller/index-info.php", { 
      method: "POST", 
      body: formData 
  })
  .then(res => res.json())
  .then(data => {
    // Store raw data for export
    window.tadiReportData = data;

    // Check if there’s no data
    if (!data || data.length === 0) {
        reportContainer.innerHTML = `
            <div class="alert alert-warning text-center mt-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                No TADI records found for the selected criteria.
            </div>
        `;
        document.querySelector(".export-content").innerHTML = `
            <h4>${headerLabel} Report</h4>
            <button class="btn btn-success export-all-btn" id="exportAll" disabled>
                <i class="fas fa-file-excel me-2"></i>Export All to Excel
            </button>
        `;
        return; // stop further processing
    }

    const teacherGroups = data.reduce((groups, record) => {
        const group = groups[record.SchlEmpSms_ID] || {
            prof_name: record.prof_name,
            subjects: {}
        };
        
        if (!group.subjects[record.subject_code]) {
            group.subjects[record.subject_code] = {
                subject_code: record.subject_code,
                subject_desc: record.subject_desc,
                section_name: record.section_name,
                sessions: []
            };
        }

        if (record.schltadi_id) {
            group.subjects[record.subject_code].sessions.push({
                date: record.tadi_date,
                time_in: formatTimeToAmPm(record.time_in),
                time_out: formatTimeToAmPm(record.time_out),
                duration: record.duration,
                mode: record.mode == 'online_learning' ? 'Online' : 'Onsite',
                type: record.type,
                session_type: record.session_type,
                status: record.status,
                activity: record.activity ? record.activity.replace(/\\r\\n/g, "<br>") : 'No activity recorded',
                stud_name: record.student_name
            });
        }

        groups[record.SchlEmpSms_ID] = group;
        return groups;
    }, {});

    // Generate HTML output
    reportContainer.innerHTML = `
        ${Object.entries(teacherGroups)
            .map(([profId, teacher]) => `
              <div class="card mb-4">
                    <div class="card-header text-white subject-card-header">
                        <h5 class="mb-0">${teacher.prof_name}</h5>
                    </div>
                    <div class="card-body">
                        ${Object.values(teacher.subjects).map(subject => `
                            <div class="mb-4">
                                <h6>${subject.subject_code} - ${subject.subject_desc}</h6>
                                <p class="small text-muted">Section: ${subject.section_name || 'No Section'}</p>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Duration</th>
                                                <th>Session Type</th>
                                                <th>Submitted By</th>
                                                <th>Activity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${subject.sessions.map(session => `
                                                <tr>
                                                    <td>${session.date}</td>
                                                    <td>${session.time_in} - ${session.time_out}</td>
                                                    <td>${session.duration}</td>
                                                    <td>${session.mode} ${session.session_type}</td>
                                                    <td>${session.stud_name}</td>
                                                    <td>${session.activity}</td>
                                                    <td>
                                                        <span class="badge ${session.status == 1 ? 'bg-success' : 'bg-danger'}">
                                                            ${session.status == 1 ? 'Verified' : 'Unverified'}
                                                        </span>
                                                    </td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
          `).join('')}`;

    // Add Export button
    document.querySelector(".export-content").innerHTML = `
        <h4>${headerLabel} Report</h4>
        <button class="btn btn-success export-all-btn" id="exportAll">
            <i class="fas fa-file-excel me-2"></i>Export All to Excel
        </button>
    `;

    document.getElementById("exportAll").addEventListener("click", () => {
        const data = window.tadiReportData;
        if (!data || !data.length) {
            alert('No data available to export');
            return;
        }

        // Create workbook and worksheet
        const wb = XLSX.utils.book_new();
        const allRows = [];

        // Add headers
        allRows.push([
            'Professor Name',
            'Subject Code',
            'Subject Description',
            'Section',
            'Student Name',
            'Date',
            'Time In',
            'Time Out',
            'Duration',
            'Mode',
            'Session Type',
            'Activity',
            'Status'
        ]);

        // Sort by professor name to group them together
        data.sort((a, b) => a.prof_name.localeCompare(b.prof_name));

        let currentProf = null;

        // Process data and insert blank rows between professors
        data.forEach(record => {
            if (!record.schltadi_id) return;

            // Insert a blank row when the professor changes (skip before first)
            if (currentProf && record.prof_name !== currentProf) {
                allRows.push([]); // blank row separator
            }

            allRows.push([
                record.prof_name,
                record.subject_code,
                record.subject_desc,
                record.section_name || 'No Section',
                record.student_name,
                record.tadi_date,
                record.time_in,
                record.time_out,
                record.duration,
                record.mode,
                record.session_type,
                record.activity || 'No activity recorded',
                record.status == 1 ? 'Verified' : 'Unverified'
            ]);

            currentProf = record.prof_name;
        });

        // Create worksheet
        const ws = XLSX.utils.aoa_to_sheet(allRows);

        // Set column widths
        ws['!cols'] = [
            { wch: 30 }, // Professor Name
            { wch: 15 }, // Subject Code
            { wch: 40 }, // Subject Description
            { wch: 15 }, // Section
            { wch: 30 }, // Student Name
            { wch: 12 }, // Date
            { wch: 10 }, // Time In
            { wch: 10 }, // Time Out
            { wch: 10 }, // Duration
            { wch: 15 }, // Mode
            { wch: 12 }, // Session Type
            { wch: 50 }, // Activity
            { wch: 10 }  // Status
        ];

        // Style headers
        const range = XLSX.utils.decode_range(ws['!ref']);
        for (let C = range.s.c; C <= range.e.c; ++C) {
            const address = XLSX.utils.encode_cell({ r: 0, c: C });
            if (!ws[address]) continue;
            ws[address].s = {
                fill: { fgColor: { rgb: "FFFF00" } },
                font: { bold: true }
            };
        }

        // Append worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, "TADI Records");

        // Generate filename
        const filename = `${exprtname}.xlsx`;

        // Save file
        XLSX.writeFile(wb, filename);
        });
    })
.catch(err => console.error("Error generating TADI report:", err))
.finally(() => {
  repBtn.disabled = false;
  backTadi.disabled = false;
});
})

