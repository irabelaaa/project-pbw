<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SENSORA - Pendaftaran</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      :root {
        --primary: #0ea5e9;
        --primary-dark: #0284c7;
        --bs-font-sans-serif: "Nunito", sans-serif;
      }
      body { font-family: "Nunito", sans-serif; background: #f1f5f9; }

      /* SIDEBAR */
      .sidebar {
        position: fixed; top: 0; left: 0;
        width: 240px; height: 100vh;
        background: var(--primary);
        display: flex; flex-direction: column;
        z-index: 100;
        box-shadow: 4px 0 20px rgba(14,165,233,.2);
      }
      .sidebar-brand { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,.2); }
      .sidebar-brand .brand { font-size: 22px; font-weight: 800; color:#fff; letter-spacing:3px; font-style:italic; }
      .sidebar-brand .brand-sub { font-size: 10px; color: rgba(255,255,255,.65); letter-spacing:1px; text-transform:uppercase; margin-top:2px; }
      .sidebar-nav { flex:1; padding: 20px 12px; display:flex; flex-direction:column; gap:4px; }
      .nav-item {
        display:flex; align-items:center; gap:12px;
        padding: 12px 16px; border-radius:12px;
        color: rgba(255,255,255,.75); font-size:14px; font-weight:600;
        cursor:pointer; transition:all .2s; text-decoration:none;
      }
      .nav-item:hover, .nav-item.active { background: rgba(255,255,255,.18); color:#fff; }
      .nav-item .icon { font-size:18px; width:24px; text-align:center; }
      .sidebar-footer { padding:16px 12px; border-top:1px solid rgba(255,255,255,.15); }
      .user-info { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; background:rgba(255,255,255,.12); margin-bottom:8px; }
      .user-avatar { width:36px; height:36px; border-radius:10px; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:16px; }
      .user-name { font-size:12px; font-weight:700; color:#fff; }
      .user-role { font-size:10px; color:rgba(255,255,255,.6); }
      .logout-btn { width:100%; padding:10px; border:none; border-radius:10px; background:rgba(239,68,68,.15); color:#fca5a5; font-family:"Nunito",sans-serif; font-weight:700; font-size:13px; cursor:pointer; transition:.2s; }
      .logout-btn:hover { background:rgba(239,68,68,.3); color:#fff; }

      /* MAIN */
      .main { margin-left:240px; min-height:100vh; padding:32px; }

      /* STAT CARDS */
      .stat-icon { width:50px; height:50px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:22px; }
      .stat-icon.daftar { background:#e0f2fe; }
      .stat-icon.proses { background:#fef9c3; }
      .stat-icon.selesai { background:#dcfce7; }
      .stat-num { font-size:28px; font-weight:800; color:#1e1e2e; }
      .stat-label { font-size:13px; color:#64748b; font-weight:600; }

      /* FORM LABELS */
      .form-label-upper { font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px; }

      /* BADGES */
      .badge-menunggu { background:#f3e8ff; color:#7c3aed; }
      .badge-sudah { background:#dcfce7; color:#15803d; }

      /* CUSTOM ACTION BUTTONS */
      .btn-edit-sm { padding:5px 12px; background:#dbeafe; color:#1d4ed8; border:none; border-radius:8px; font-family:"Nunito",sans-serif; font-weight:700; font-size:12px; cursor:pointer; }
      .btn-edit-sm:hover { background:#bfdbfe; }
      .btn-del-sm { padding:5px 12px; background:#fee2e2; color:#dc2626; border:none; border-radius:8px; font-family:"Nunito",sans-serif; font-weight:700; font-size:12px; cursor:pointer; }
      .btn-del-sm:hover { background:#fca5a5; }

      .empty-state { text-align:center; padding:40px; color:#64748b; font-size:14px; }

      /* TOAST */
      .toast-custom { position:fixed; top:24px; right:24px; padding:14px 22px; border-radius:12px; font-size:14px; font-weight:700; color:#fff; z-index:9999; opacity:0; transform:translateY(-10px); transition:all .3s ease; pointer-events:none; }
      .toast-custom.show { opacity:1; transform:translateY(0); }
      .toast-custom.success { background:#22c55e; }
      .toast-custom.error { background:#ef4444; }
    </style>
  </head>
  <body>

    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <div class="brand">SENSORA</div>
        <div class="brand-sub">Modul Pendaftaran</div>
      </div>
      <nav class="sidebar-nav">
        <a class="nav-item active" onclick="showSection('input')">
          <span class="icon">📋</span> Input Data Pasien
        </a>
        <a class="nav-item" onclick="showSection('daftar')">
          <span class="icon">🗂️</span> Daftar Pasien Berobat
        </a>
      </nav>
      <div class="sidebar-footer">
        <div class="user-info">
          <div class="user-avatar">🖥️</div>
          <div>
            <div class="user-name" id="sidebarUser">-</div>
            <div class="user-role">Petugas Pendaftaran</div>
          </div>
        </div>
        <button class="logout-btn" onclick="logout()">🚪 Keluar</button>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <div class="fw-bold fs-5" id="sectionTitle">📋 Input Data Pasien</div>
          <div class="text-muted small fw-semibold" id="pageDate"></div>
        </div>
      </div>

      <!-- STATS -->
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon daftar">📋</div>
            <div>
              <div class="stat-num" id="statTotal">0</div>
              <div class="stat-label">Total Pasien Hari Ini</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon proses">⏳</div>
            <div>
              <div class="stat-num" id="statMenunggu">0</div>
              <div class="stat-label">Menunggu Input Rawat Inap</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon selesai">✅</div>
            <div>
              <div class="stat-num" id="statSelesai">0</div>
              <div class="stat-label">Sudah Diinput Rawat Inap</div>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION: FORM INPUT -->
      <div id="sectionInput">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <h6 class="fw-bold mb-4">📋 Form Pendaftaran Pasien</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label-upper">Nama Pasien *</label>
              <input type="text" class="form-control" id="nama" placeholder="Nama lengkap pasien" autocomplete="off" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">No. Rekam Medis *</label>
              <input type="text" class="form-control" id="noRM" placeholder="Contoh: RM-2024-001" autocomplete="off" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tglLahir" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Jenis Kelamin</label>
              <select class="form-select" id="jenisKelamin">
                <option value="">-- Pilih --</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-upper">Alamat</label>
              <input type="text" class="form-control" id="alamat" placeholder="Alamat lengkap pasien" autocomplete="off" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">No. Telepon</label>
              <input type="text" class="form-control" id="noTelp" placeholder="Contoh: 081234567890" autocomplete="off" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Jenis Pembiayaan *</label>
              <select class="form-select" id="pembiayaan">
                <option value="">-- Pilih Pembiayaan --</option>
                <option>BPJS</option>
                <option>Umum / Mandiri</option>
                <option>Asuransi Swasta</option>
                <option>Jasa Raharja</option>
                <option>SKTM</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-upper">Keluhan / Diagnosa Awal *</label>
              <input type="text" class="form-control" id="diagnosa" placeholder="Keluhan atau diagnosa awal pasien" autocomplete="off" />
            </div>
            <div class="col-12">
              <label class="form-label-upper">Dokter yang Dituju *</label>
              <input type="text" class="form-control" id="dokter" placeholder="Nama dokter yang akan menangani" autocomplete="off" />
            </div>
            <div class="col-12">
              <label class="form-label-upper">Catatan Tambahan</label>
              <textarea class="form-control" id="catatan" rows="3" placeholder="Catatan tambahan jika ada..."></textarea>
            </div>
          </div>
          <div class="d-flex gap-2 mt-4">
            <button class="btn btn-primary fw-bold" onclick="simpanData()">💾 Daftarkan Pasien</button>
            <button class="btn btn-secondary fw-bold" onclick="resetForm()">🔄 Reset Form</button>
          </div>
        </div>
      </div>

      <!-- SECTION: DAFTAR -->
      <div id="sectionDaftar" style="display:none;">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <h6 class="fw-bold mb-3">🗂️ Daftar Pasien Berobat Hari Ini</h6>
          <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size:13px;">
              <thead class="table-light">
                <tr>
                  <th>No</th><th>No. RM</th><th>Nama Pasien</th>
                  <th>Tgl. Lahir</th><th>Jenis Kelamin</th><th>No. Telepon</th>
                  <th>Pembiayaan</th><th>Diagnosa Awal</th><th>Dokter</th>
                  <th>Waktu Daftar</th><th>Status Rawat Inap</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabelPasien">
                <tr><td colspan="12" class="empty-state">Belum ada data pasien hari ini</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0">
          <div class="modal-header border-0 pb-0">
            <h6 class="modal-title fw-bold">✏️ Edit Data Pasien Berobat</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-upper">Nama Pasien *</label>
                <input type="text" class="form-control" id="editNama" autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">No. Rekam Medis *</label>
                <input type="text" class="form-control" id="editNoRM" autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Tanggal Lahir</label>
                <input type="date" class="form-control" id="editTglLahir" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Jenis Kelamin</label>
                <select class="form-select" id="editJenisKelamin">
                  <option value="">-- Pilih --</option>
                  <option>Laki-laki</option>
                  <option>Perempuan</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-upper">Alamat</label>
                <input type="text" class="form-control" id="editAlamat" autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">No. Telepon</label>
                <input type="text" class="form-control" id="editNoTelp" autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Jenis Pembiayaan *</label>
                <select class="form-select" id="editPembiayaan">
                  <option value="">-- Pilih Pembiayaan --</option>
                  <option>BPJS</option>
                  <option>Umum / Mandiri</option>
                  <option>Asuransi Swasta</option>
                  <option>Jasa Raharja</option>
                  <option>SKTM</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-upper">Keluhan / Diagnosa Awal *</label>
                <input type="text" class="form-control" id="editDiagnosa" autocomplete="off" />
              </div>
              <div class="col-12">
                <label class="form-label-upper">Dokter yang Dituju *</label>
                <input type="text" class="form-control" id="editDokter" autocomplete="off" />
              </div>
              <div class="col-12">
                <label class="form-label-upper">Catatan Tambahan</label>
                <textarea class="form-control" id="editCatatan" rows="3"></textarea>
              </div>
            </div>
            <input type="hidden" id="editId" />
          </div>
          <div class="modal-footer border-0 pt-0">
            <button class="btn btn-primary fw-bold" onclick="simpanEdit()">💾 Simpan Perubahan</button>
            <button class="btn btn-secondary fw-bold" data-bs-dismiss="modal">✖️ Batal</button>
          </div>
        </div>
      </div>
    </div>

    <div class="toast-custom" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const role = localStorage.getItem("role");
      const loggedUser = localStorage.getItem("loggedUser");
      const displayUser = loggedUser || "Petugas";
      document.getElementById("sidebarUser").textContent = displayUser.split("@")[0];

      const today = new Date();
      const opts = { weekday:"long", year:"numeric", month:"long", day:"numeric" };
      document.getElementById("pageDate").textContent = today.toLocaleDateString("id-ID", opts);

      const todayStr = today.toISOString().split("T")[0];
      const BEROBAT_KEY = "sensora_berobat";

      function getData() { return JSON.parse(localStorage.getItem(BEROBAT_KEY) || "[]"); }
      function saveData(d) { localStorage.setItem(BEROBAT_KEY, JSON.stringify(d)); }

      function getTodayData() {
        return getData().filter(p => {
          const waktu = p.waktuDaftar ? p.waktuDaftar.split("T")[0] : "";
          return waktu === todayStr;
        });
      }

      function updateStats() {
        const data = getTodayData();
        document.getElementById("statTotal").textContent = data.length;
        document.getElementById("statMenunggu").textContent = data.filter(p => !p.sudahInput).length;
        document.getElementById("statSelesai").textContent = data.filter(p => p.sudahInput).length;
      }

      function renderTable() {
        const data = getTodayData();
        const tbody = document.getElementById("tabelPasien");
        if (data.length === 0) {
          tbody.innerHTML = '<tr><td colspan="12" class="empty-state">Belum ada data pasien hari ini</td></tr>';
          return;
        }
        tbody.innerHTML = data.map((p, i) => `
          <tr>
            <td>${i+1}</td>
            <td>${p.noRM}</td>
            <td><strong>${p.nama}</strong></td>
            <td>${p.tglLahir || "-"}</td>
            <td>${p.jenisKelamin || "-"}</td>
            <td>${p.noTelp || "-"}</td>
            <td>${p.pembiayaan}</td>
            <td>${p.diagnosa}</td>
            <td>${p.dokter}</td>
            <td>${new Date(p.waktuDaftar).toLocaleTimeString("id-ID",{hour:"2-digit",minute:"2-digit"})}</td>
            <td><span class="badge rounded-pill ${p.sudahInput ? "badge-sudah" : "badge-menunggu"}">${p.sudahInput ? "✅ Sudah Input" : "⏳ Menunggu"}</span></td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-edit-sm" onclick="bukaEdit('${p.id}')">✏️ Edit</button>
                ${!p.sudahInput ? `<button class="btn-del-sm" onclick="hapus('${p.id}')">🗑️ Hapus</button>` : ""}
              </div>
            </td>
          </tr>
        `).join("");
      }

      function simpanData() {
        const nama = document.getElementById("nama").value.trim();
        const noRM = document.getElementById("noRM").value.trim();
        const tglLahir = document.getElementById("tglLahir").value;
        const jenisKelamin = document.getElementById("jenisKelamin").value;
        const alamat = document.getElementById("alamat").value.trim();
        const noTelp = document.getElementById("noTelp").value.trim();
        const pembiayaan = document.getElementById("pembiayaan").value;
        const diagnosa = document.getElementById("diagnosa").value.trim();
        const dokter = document.getElementById("dokter").value.trim();
        const catatan = document.getElementById("catatan").value.trim();

        if (!nama || !noRM || !pembiayaan || !diagnosa || !dokter) {
          showToast("Field bertanda * wajib diisi!", "error"); return;
        }

        const pasien = {
          id: Date.now().toString(), nama, noRM, tglLahir, jenisKelamin,
          alamat, noTelp, pembiayaan, diagnosa, dokter, catatan,
          sudahInput: false, inputBy: displayUser, waktuDaftar: new Date().toISOString()
        };
        const data = getData();
        data.push(pasien);
        saveData(data);
        showToast(`Pasien ${nama} berhasil didaftarkan!`, "success");
        resetForm();
        updateStats();
      }

      function bukaEdit(id) {
        const p = getData().find(p => p.id === id);
        if (!p) return;
        document.getElementById("editId").value = id;
        document.getElementById("editNama").value = p.nama || "";
        document.getElementById("editNoRM").value = p.noRM || "";
        document.getElementById("editTglLahir").value = p.tglLahir || "";
        document.getElementById("editJenisKelamin").value = p.jenisKelamin || "";
        document.getElementById("editAlamat").value = p.alamat || "";
        document.getElementById("editNoTelp").value = p.noTelp || "";
        document.getElementById("editPembiayaan").value = p.pembiayaan || "";
        document.getElementById("editDiagnosa").value = p.diagnosa || "";
        document.getElementById("editDokter").value = p.dokter || "";
        document.getElementById("editCatatan").value = p.catatan || "";
        new bootstrap.Modal(document.getElementById("modalEdit")).show();
      }

      function tutupModal() {
        bootstrap.Modal.getInstance(document.getElementById("modalEdit"))?.hide();
      }

      function simpanEdit() {
        const id = document.getElementById("editId").value;
        const data = getData();
        const idx = data.findIndex(p => p.id === id);
        if (idx === -1) return;
        const nama = document.getElementById("editNama").value.trim();
        const noRM = document.getElementById("editNoRM").value.trim();
        const pembiayaan = document.getElementById("editPembiayaan").value;
        const diagnosa = document.getElementById("editDiagnosa").value.trim();
        const dokter = document.getElementById("editDokter").value.trim();
        if (!nama || !noRM || !pembiayaan || !diagnosa || !dokter) {
          showToast("Field bertanda * wajib diisi!", "error"); return;
        }
        data[idx] = {
          ...data[idx], nama, noRM,
          tglLahir: document.getElementById("editTglLahir").value,
          jenisKelamin: document.getElementById("editJenisKelamin").value,
          alamat: document.getElementById("editAlamat").value.trim(),
          noTelp: document.getElementById("editNoTelp").value.trim(),
          pembiayaan, diagnosa, dokter,
          catatan: document.getElementById("editCatatan").value.trim()
        };
        saveData(data);
        tutupModal();
        renderTable();
        updateStats();
        showToast("Data berhasil diperbarui!", "success");
      }

      function hapus(id) {
        if (!confirm("Yakin ingin menghapus data ini?")) return;
        saveData(getData().filter(p => p.id !== id));
        renderTable();
        updateStats();
        showToast("Data berhasil dihapus", "success");
      }

      function resetForm() {
        ["nama","noRM","alamat","noTelp","diagnosa","dokter","catatan"].forEach(id => document.getElementById(id).value = "");
        document.getElementById("tglLahir").value = "";
        document.getElementById("jenisKelamin").value = "";
        document.getElementById("pembiayaan").value = "";
      }

      function showSection(section) {
        document.getElementById("sectionInput").style.display = section === "input" ? "block" : "none";
        document.getElementById("sectionDaftar").style.display = section === "daftar" ? "block" : "none";
        document.getElementById("sectionTitle").textContent = section === "input" ? "📋 Input Data Pasien" : "🗂️ Daftar Pasien Berobat";
        document.querySelectorAll(".nav-item").forEach((el, i) => {
          el.classList.toggle("active", (section==="input"&&i===0)||(section==="daftar"&&i===1));
        });
        if (section === "daftar") renderTable();
      }

      function showToast(msg, type) {
        const toast = document.getElementById("toast");
        toast.textContent = msg;
        toast.className = `toast-custom ${type} show`;
        setTimeout(() => toast.className = "toast-custom", 3000);
      }

      function logout() {
        localStorage.removeItem("role");
        localStorage.removeItem("loggedUser");
        window.location.href = "/pilihakses";
      }

      updateStats();
    </script>
  </body>
</html>
<?php /**PATH C:\laragon\www\project-pbw\resources\views/pendaftaran.blade.php ENDPATH**/ ?>