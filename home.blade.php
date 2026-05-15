<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SENSORA - Perawat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
      :root {
        --primary: #4f46e5;
        --primary-light: #ede9fe;
        --bs-font-sans-serif: "Nunito", sans-serif;
      }
      body { font-family: "Nunito", sans-serif; background: #f1f5f9; }

      .sidebar {
        position: fixed; top: 0; left: 0; width: 240px; height: 100vh;
        background: var(--primary); display: flex; flex-direction: column;
        z-index: 100; box-shadow: 4px 0 20px rgba(79, 70, 229, 0.15);
      }
      .sidebar-brand { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.15); }
      .sidebar-brand .brand { font-size: 22px; font-weight: 800; color: #fff; letter-spacing: 3px; }
      .sidebar-brand .brand-sub { font-size: 10px; color: rgba(255, 255, 255, 0.6); letter-spacing: 1px; text-transform: uppercase; margin-top: 2px; }
      .sidebar-nav { flex: 1; padding: 20px 12px; display: flex; flex-direction: column; gap: 4px; }
      .nav-section-label { font-size: 10px; font-weight: 800; color: rgba(255, 255, 255, 0.35); text-transform: uppercase; letter-spacing: 1.5px; padding: 6px 16px 4px; }
      .nav-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px; border-radius: 8px;
        color: rgba(255, 255, 255, 0.7); font-size: 14px; font-weight: 600;
        cursor: pointer; transition: all 0.2s; text-decoration: none;
      }
      .nav-item:hover, .nav-item.active { background: rgba(255, 255, 255, 0.15); color: #fff; }
      .nav-item i { width: 24px; text-align: center; }
      .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255, 255, 255, 0.15); }
      .user-info { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; background: rgba(255, 255, 255, 0.1); margin-bottom: 8px; }
      .user-avatar { width: 36px; height: 36px; border-radius: 6px; background: rgba(255, 255, 255, 0.25); display: flex; align-items: center; justify-content: center; }
      .user-avatar i { font-size: 18px; color: #fff; }
      .user-name { font-size: 12px; font-weight: 700; color: #fff; }
      .user-role { font-size: 10px; color: rgba(255, 255, 255, 0.6); }
      .logout-btn { width: 100%; padding: 10px; border: none; border-radius: 6px; background: rgba(239, 68, 68, 0.15); color: #fca5a5; font-family: "Nunito", sans-serif; font-weight: 700; font-size: 13px; cursor: pointer; transition: 0.2s; }
      .logout-btn:hover { background: rgba(239, 68, 68, 0.3); color: #fff; }

      .main { margin-left: 240px; min-height: 100vh; padding: 32px; }

      .stat-icon { width: 50px; height: 50px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
      .stat-icon.masuk { background: #dbeafe; color: #0284c7; }
      .stat-icon.keluar { background: #dcfce7; color: #15803d; }
      .stat-icon.aktif { background: #fef9c3; color: #92400e; }
      .stat-num { font-size: 28px; font-weight: 800; color: #1e1e2e; }
      .stat-label { font-size: 13px; color: #64748b; font-weight: 600; }

      .form-label-upper { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }

      .badge-masuk { background: #dbeafe; color: #1d4ed8; }
      .badge-keluar { background: #dcfce7; color: #15803d; }
      .badge-pindah { background: #fef9c3; color: #92400e; }
      .badge-menunggu { background: #f3e8ff; color: #7c3aed; }

      .btn-edit-sm { padding: 5px 12px; background: #dbeafe; color: #1d4ed8; border: none; border-radius: 6px; font-family: "Nunito", sans-serif; font-weight: 700; font-size: 12px; cursor: pointer; }
      .btn-edit-sm:hover { background: #bfdbfe; }
      .btn-del-sm { padding: 5px 12px; background: #fee2e2; color: #dc2626; border: none; border-radius: 6px; font-family: "Nunito", sans-serif; font-weight: 700; font-size: 12px; cursor: pointer; }
      .btn-del-sm:hover { background: #fca5a5; }
      .btn-input-sm { padding: 5px 12px; background: #dcfce7; color: #15803d; border: none; border-radius: 6px; font-family: "Nunito", sans-serif; font-weight: 700; font-size: 12px; cursor: pointer; white-space: nowrap; }
      .btn-input-sm:hover { background: #bbf7d0; }

      .empty-state { text-align: center; padding: 40px; color: #64748b; font-size: 14px; }

      .toast-custom { position: fixed; top: 24px; right: 24px; padding: 14px 22px; border-radius: 8px; font-size: 14px; font-weight: 700; color: #fff; z-index: 9999; opacity: 0; transform: translateY(-10px); transition: all 0.3s ease; pointer-events: none; }
      .toast-custom.show { opacity: 1; transform: translateY(0); }
      .toast-custom.success { background: #22c55e; }
      .toast-custom.error { background: #ef4444; }
      .toast-custom.info { background: var(--primary); }

      .highlight-row { animation: highlightFade 2s ease-out; }
      @keyframes highlightFade { 0% { background: #dcfce7; } 100% { background: transparent; } }

      .card { border-radius: 8px; }
      .form-control, .form-select { border-radius: 6px; }
      .modal-content { border-radius: 8px; }
    </style>
  </head>
  <body>

    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="sidebar-brand">
        <div class="brand">SENSORA</div>
        <div class="brand-sub">Sensus Harian Rawat Inap</div>
      </div>
      <nav class="sidebar-nav">
        <a class="nav-item active" onclick="showSection('input')" id="nav-input">
          <i class="bi bi-pencil-square"></i> Input Data Pasien Rawat Inap
        </a>
        <a class="nav-item" onclick="showSection('daftar')" id="nav-daftar">
          <i class="bi bi-list-check"></i> Daftar Pasien Rawat Inap
        </a>
        <a class="nav-item" onclick="showSection('berobat')" id="nav-berobat">
          <i class="bi bi-file-text"></i> Daftar Pasien Berobat
        </a>
        <div style="height: 1px; background: rgba(255, 255, 255, 0.12); margin: 10px 4px;"></div>
        <div class="nav-section-label">Pengaturan</div>
        <a class="nav-item" onclick="showSection('aturRuang')" id="nav-aturRuang">
          <i class="bi bi-hospital"></i> Atur Ruang Bangsal
        </a>
        <a class="nav-item" onclick="showSection('aturKelas')" id="nav-aturKelas">
          <i class="bi bi-door-closed"></i> Atur Kelas Perawatan
        </a>
      </nav>
      <div class="sidebar-footer">
        <div class="user-info">
          <div class="user-avatar">
            <i class="bi bi-person-nurse"></i>
          </div>
          <div>
            <div class="user-name" id="sidebarUser">-</div>
            <div class="user-role">Perawat</div>
          </div>
        </div>
        <button class="logout-btn" onclick="logout()"><i class="bi bi-box-arrow-right"></i> Keluar</button>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <div class="fw-bold fs-5" id="sectionTitle"><i class="bi bi-pencil-square"></i> Input Data Pasien Rawat Inap</div>
          <div class="text-muted small fw-semibold" id="pageDate"></div>
        </div>
      </div>

      <!-- STATS -->
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon masuk"><i class="bi bi-hospital"></i></div>
            <div>
              <div class="stat-num" id="statMasuk">0</div>
              <div class="stat-label">Pasien Masuk Hari Ini</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon keluar"><i class="bi bi-check-circle"></i></div>
            <div>
              <div class="stat-num" id="statKeluar">0</div>
              <div class="stat-label">Pasien Keluar Hari Ini</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon aktif"><i class="bi bi-door-open"></i></div>
            <div>
              <div class="stat-num" id="statAktif">0</div>
              <div class="stat-label">Total Data Hari Ini</div>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION: INPUT FORM -->
      <div id="sectionInput">
        <div id="autofillBanner" class="alert alert-success border-start border-4 rounded-0 fw-bold mb-3" style="display: none;">
          <i class="bi bi-check-circle"></i> Data pasien <span id="autofillName"></span> telah diisi otomatis dari Daftar Pasien Berobat. Lengkapi data yang masih kosong.
        </div>
        <div class="card border-0 shadow-sm p-4 mb-4">
          <h6 class="fw-bold mb-4"><i class="bi bi-hospital"></i> Form Input Data Pasien Rawat Inap</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label-upper">Nama Pasien *</label>
              <input type="text" class="form-control" id="namaPasien" placeholder="Nama lengkap pasien" autocomplete="off" />
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
              <label class="form-label-upper">Jenis Kelamin *</label>
              <select class="form-select" id="jenisKelamin">
                <option value="">-- Pilih --</option>
                <option>Laki-laki</option><option>Perempuan</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Tanggal Masuk *</label>
              <input type="date" class="form-control" id="tglMasuk" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Tanggal Keluar</label>
              <input type="date" class="form-control" id="tglKeluar" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Ruang / Bangsal *</label>
              <select class="form-select" id="ruang">
                <option value="">-- Pilih Ruang --</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Nomor Tempat Tidur *</label>
              <input type="text" class="form-control" id="noTT" placeholder="Contoh: 01, 02A" autocomplete="off" />
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Kelas Perawatan *</label>
              <select class="form-select" id="kelas">
                <option value="">-- Pilih Kelas --</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Cara Masuk *</label>
              <select class="form-select" id="caraMasuk">
                <option value="">-- Pilih Cara Masuk --</option>
                <option>Rujukan Puskesmas</option><option>Rujukan RS Lain</option>
                <option>Datang Sendiri</option><option>Rujukan Dokter Praktik</option>
                <option>Transfer Antar Ruang</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Jenis Pembiayaan *</label>
              <select class="form-select" id="pembiayaan">
                <option value="">-- Pilih Pembiayaan --</option>
                <option>BPJS</option><option>Umum / Mandiri</option>
                <option>Asuransi Swasta</option><option>Jasa Raharja</option><option>SKTM</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label-upper">Status *</label>
              <select class="form-select" id="status">
                <option value="">-- Pilih Status --</option>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
                <option value="pindah">Pindah Ruang</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-upper">Diagnosa / Penyakit *</label>
              <input type="text" class="form-control" id="diagnosa" placeholder="Contoh: Hipertensi, Demam Berdarah, dst." autocomplete="off" />
            </div>
            <div class="col-12">
              <label class="form-label-upper">Dokter Penanggung Jawab *</label>
              <input type="text" class="form-control" id="dokter" placeholder="Nama dokter DPJP" autocomplete="off" />
            </div>
          </div>
          <input type="hidden" id="berobatRefId" />
          <div class="d-flex gap-2 mt-4">
            <button class="btn btn-primary fw-bold" onclick="simpanData()"><i class="bi bi-floppy"></i> Simpan Data</button>
            <button class="btn btn-secondary fw-bold" onclick="resetForm()"><i class="bi bi-arrow-clockwise"></i> Reset Form</button>
          </div>
        </div>
      </div>

      <!-- SECTION: DAFTAR PASIEN RAWAT INAP -->
      <div id="sectionDaftar" style="display: none;">
        <div class="card border-0 shadow-sm p-4 mb-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Daftar Pasien Rawat Inap</h6>
          <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size: 13px;">
              <thead class="table-light">
                <tr>
                  <th>No</th><th>No. RM</th><th>Nama Pasien</th>
                  <th>Tgl Masuk</th><th>Tgl Keluar</th><th>Ruang</th>
                  <th>No. TT</th><th>Kelas</th><th>Cara Masuk</th>
                  <th>Pembiayaan</th><th>Diagnosa</th><th>Dokter</th>
                  <th>Status</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabelPasien">
                <tr><td colspan="14" class="empty-state">Belum ada data Pasien Rawat Inap</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SECTION: DAFTAR PASIEN BEROBAT -->
      <div id="sectionBerobat" style="display: none;">
        <div class="card border-0 shadow-sm p-4 mb-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-file-text"></i> Daftar Pasien Berobat</h6>
          <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size: 13px;">
              <thead class="table-light">
                <tr>
                  <th>No</th><th>No. RM</th><th>Nama Pasien</th>
                  <th>Tgl. Lahir</th><th>Jenis Kelamin</th><th>Alamat</th>
                  <th>No. Telepon</th><th>Pembiayaan</th><th>Diagnosa Awal</th>
                  <th>Dokter</th><th>Waktu Daftar</th><th>Status</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabelBerobat">
                <tr><td colspan="13" class="empty-state">Belum ada data pasien berobat dari pendaftaran</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SECTION: ATUR RUANG BANGSAL -->
      <div id="sectionAturRuang" style="display: none;">
        <div class="alert border-start border-4 border-primary rounded-0 mb-4" style="background: linear-gradient(135deg, #eff6ff, #e0f2fe); color: #1e40af; font-size: 13px; font-weight: 700;">
          <i class="bi bi-info-circle"></i> Perubahan ruang bangsal di sini akan langsung memperbarui pilihan pada form input &amp; edit data pasien.
        </div>
        <div class="row g-4 align-items-start">
          <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
              <h6 class="fw-bold mb-3" id="titleFormRuang"><i class="bi bi-hospital"></i> Tambah Ruang Bangsal</h6>
              <div class="mb-3">
                <label class="form-label-upper">Nama Ruang / Bangsal *</label>
                <input type="text" class="form-control" id="inputNamaRuang" placeholder="Contoh: Kenanga, Flamboyan" autocomplete="off" />
              </div>
              <div class="mb-3">
                <label class="form-label-upper">Kapasitas Tempat Tidur</label>
                <input type="number" class="form-control" id="inputKapasitasRuang" placeholder="Contoh: 20" min="1" max="999" autocomplete="off" />
              </div>
              <input type="hidden" id="editRuangId" />
              <div class="d-flex gap-2">
                <button class="btn btn-primary fw-bold" onclick="simpanRuang()"><i class="bi bi-floppy"></i> Simpan Ruang</button>
                <button class="btn btn-secondary fw-bold" onclick="resetFormRuang()"><i class="bi bi-arrow-clockwise"></i> Reset</button>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">
              <h6 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Daftar Ruang Bangsal <span id="ruangCount" class="text-muted small"></span></h6>
              <div class="table-responsive">
                <table class="table table-hover align-middle" style="font-size: 13px;">
                  <thead class="table-light">
                    <tr><th>No</th><th>Nama Ruang</th><th class="text-center">Kapasitas TT</th><th>Aksi</th></tr>
                  </thead>
                  <tbody id="tabelRuang">
                    <tr><td colspan="4" class="empty-state">Belum ada data ruang</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION: ATUR KELAS PERAWATAN -->
      <div id="sectionAturKelas" style="display: none;">
        <div class="alert border-start border-4 border-success rounded-0 mb-4" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); color: #15803d; font-size: 13px; font-weight: 700;">
          <i class="bi bi-info-circle"></i> Perubahan kelas perawatan di sini akan langsung memperbarui pilihan pada form input &amp; edit data pasien.
        </div>
        <div class="row g-4 align-items-start">
          <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
              <h6 class="fw-bold mb-3" id="titleFormKelas"><i class="bi bi-door-closed"></i> Tambah Kelas Perawatan</h6>
              <div class="mb-3">
                <label class="form-label-upper">Nama Kelas *</label>
                <input type="text" class="form-control" id="inputNamaKelas" placeholder="Contoh: Kelas I, VIP, VVIP" autocomplete="off" />
              </div>
              <div class="mb-3">
                <label class="form-label-upper">Keterangan (opsional)</label>
                <input type="text" class="form-control" id="inputKetKelas" placeholder="Contoh: Tarif per hari Rp350.000" autocomplete="off" />
              </div>
              <input type="hidden" id="editKelasId" />
              <div class="d-flex gap-2">
                <button class="btn btn-primary fw-bold" onclick="simpanKelas()"><i class="bi bi-floppy"></i> Simpan Kelas</button>
                <button class="btn btn-secondary fw-bold" onclick="resetFormKelas()"><i class="bi bi-arrow-clockwise"></i> Reset</button>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">
              <h6 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Daftar Kelas Perawatan <span id="kelasCount" class="text-muted small"></span></h6>
              <div class="table-responsive">
                <table class="table table-hover align-middle" style="font-size: 13px;">
                  <thead class="table-light">
                    <tr><th>No</th><th>Nama Kelas</th><th>Keterangan</th><th>Aksi</th></tr>
                  </thead>
                  <tbody id="tabelKelas">
                    <tr><td colspan="4" class="empty-state">Belum ada data kelas</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL EDIT PASIEN -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0">
          <div class="modal-header border-0 pb-0">
            <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square"></i> Edit Data Pasien Rawat Inap</h6>
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
                <label class="form-label-upper">Tanggal Masuk *</label>
                <input type="date" class="form-control" id="editTglMasuk" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Tanggal Keluar</label>
                <input type="date" class="form-control" id="editTglKeluar" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Ruang / Bangsal *</label>
                <select class="form-select" id="editRuang">
                  <option value="">-- Pilih Ruang --</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Nomor Tempat Tidur *</label>
                <input type="text" class="form-control" id="editNoTT" autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Kelas Perawatan *</label>
                <select class="form-select" id="editKelas">
                  <option value="">-- Pilih Kelas --</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Cara Masuk *</label>
                <select class="form-select" id="editCaraMasuk">
                  <option value="">-- Pilih Cara Masuk --</option>
                  <option>Rujukan Puskesmas</option><option>Rujukan RS Lain</option>
                  <option>Datang Sendiri</option><option>Rujukan Dokter Praktik</option>
                  <option>Transfer Antar Ruang</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Jenis Pembiayaan *</label>
                <select class="form-select" id="editPembiayaan">
                  <option value="">-- Pilih Pembiayaan --</option>
                  <option>BPJS</option><option>Umum / Mandiri</option>
                  <option>Asuransi Swasta</option><option>Jasa Raharja</option><option>SKTM</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-upper">Status *</label>
                <select class="form-select" id="editStatus">
                  <option value="">-- Pilih Status --</option>
                  <option value="masuk">Masuk</option>
                  <option value="keluar">Keluar</option>
                  <option value="pindah">Pindah Ruang</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-upper">Diagnosa / Penyakit *</label>
                <input type="text" class="form-control" id="editDiagnosa" autocomplete="off" />
              </div>
              <div class="col-12">
                <label class="form-label-upper">Dokter Penanggung Jawab *</label>
                <input type="text" class="form-control" id="editDokter" autocomplete="off" />
              </div>
            </div>
            <input type="hidden" id="editId" />
          </div>
          <div class="modal-footer border-0 pt-0">
            <button class="btn btn-primary fw-bold" onclick="simpanEdit()"><i class="bi bi-floppy"></i> Simpan Perubahan</button>
            <button class="btn btn-secondary fw-bold" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>

    <div class="toast-custom" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const role = localStorage.getItem("role");
      const loggedUser = localStorage.getItem("loggedUser");
      if (!role || !loggedUser || role !== "perawat") {
        window.location.href = "/pilihakses";
      }
      document.getElementById("sidebarUser").textContent = loggedUser ? loggedUser.split("@")[0] : "-";

      const today = new Date();
      const options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
      document.getElementById("pageDate").textContent = today.toLocaleDateString("id-ID", options);

      const todayStr = today.toISOString().split("T")[0];
      document.getElementById("tglMasuk").value = todayStr;

      const STORAGE_KEY = "sensora_pasien";
      const BEROBAT_KEY = "sensora_berobat";

      function getData() { return JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]"); }
      function saveData(data) { localStorage.setItem(STORAGE_KEY, JSON.stringify(data)); }
      function getBerobatData() { return JSON.parse(localStorage.getItem(BEROBAT_KEY) || "[]"); }

      function getTodayData() {
        return getData().filter(p => p.tglMasuk === todayStr || p.tglKeluar === todayStr);
      }

      function updateStats() {
        const todayData = getTodayData();
        document.getElementById("statMasuk").textContent = todayData.filter(p => p.status === "masuk").length;
        document.getElementById("statKeluar").textContent = todayData.filter(p => p.status === "keluar").length;
        document.getElementById("statAktif").textContent = todayData.length;
      }

      function renderTable() {
        const todayData = getTodayData();
        const tbody = document.getElementById("tabelPasien");
        if (todayData.length === 0) {
          tbody.innerHTML = '<tr><td colspan="14" class="empty-state">Belum ada data Pasien Rawat Inap</td></tr>';
          return;
        }
        tbody.innerHTML = todayData.map((p, i) => `
          <tr id="row-${p.id}">
            <td>${i + 1}</td><td>${p.noRM}</td><td><strong>${p.nama}</strong></td>
            <td>${p.tglMasuk}</td><td>${p.tglKeluar || "-"}</td><td>${p.ruang}</td>
            <td>${p.noTT}</td><td>${p.kelas}</td><td>${p.caraMasuk}</td>
            <td>${p.pembiayaan}</td><td>${p.diagnosa}</td><td>${p.dokter}</td>
            <td><span class="badge rounded-pill badge-${p.status}">${p.status.charAt(0).toUpperCase() + p.status.slice(1)}</span></td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-edit-sm" onclick="bukaEdit('${p.id}')"><i class="bi bi-pencil"></i> Edit</button>
                <button class="btn-del-sm" onclick="hapusData('${p.id}')"><i class="bi bi-trash"></i> Hapus</button>
              </div>
            </td>
          </tr>
        `).join("");
      }

      function renderBerobat() {
        const data = getBerobatData();
        const tbody = document.getElementById("tabelBerobat");
        if (data.length === 0) {
          tbody.innerHTML = '<tr><td colspan="13" class="empty-state">Belum ada data pasien berobat dari pendaftaran</td></tr>';
          return;
        }
        tbody.innerHTML = data.map((p, i) => {
          const sudahInput = p.sudahInput || false;
          return `
            <tr>
              <td>${i + 1}</td><td>${p.noRM}</td><td><strong>${p.nama}</strong></td>
              <td>${p.tglLahir || "-"}</td><td>${p.jenisKelamin || "-"}</td>
              <td>${p.alamat || "-"}</td><td>${p.noTelp || "-"}</td>
              <td>${p.pembiayaan}</td><td>${p.diagnosa}</td><td>${p.dokter}</td>
              <td>${p.waktuDaftar ? new Date(p.waktuDaftar).toLocaleString("id-ID") : "-"}</td>
              <td><span class="badge rounded-pill ${sudahInput ? "badge-keluar" : "badge-menunggu"}">${sudahInput ? "<i class='bi bi-check-circle'></i> Sudah Input" : "<i class='bi bi-hourglass-split'></i> Menunggu"}</span></td>
              <td>
                ${!sudahInput ? `<button class="btn-input-sm" onclick="inputDariBerobat('${p.id}')"><i class="bi bi-pencil-square"></i> Input Rawat Inap</button>` : `<span class="text-muted small"><i class="bi bi-check-circle"></i> Selesai</span>`}
              </td>
            </tr>
          `;
        }).join("");
      }

      function inputDariBerobat(id) {
        const data = getBerobatData();
        const pasien = data.find(p => p.id === id);
        if (!pasien) return;
        document.getElementById("namaPasien").value = pasien.nama || "";
        document.getElementById("noRM").value = pasien.noRM || "";
        document.getElementById("tglLahir").value = pasien.tglLahir || "";
        document.getElementById("jenisKelamin").value = pasien.jenisKelamin || "";
        document.getElementById("tglMasuk").value = todayStr;
        document.getElementById("tglKeluar").value = "";
        document.getElementById("ruang").value = "";
        document.getElementById("noTT").value = "";
        document.getElementById("kelas").value = "";
        document.getElementById("caraMasuk").value = "";
        document.getElementById("pembiayaan").value = pasien.pembiayaan || "";
        document.getElementById("status").value = "masuk";
        document.getElementById("diagnosa").value = pasien.diagnosa || "";
        document.getElementById("dokter").value = pasien.dokter || "";
        document.getElementById("berobatRefId").value = id;
        document.getElementById("autofillBanner").style.display = "block";
        document.getElementById("autofillName").textContent = pasien.nama;
        showSection("input");
        showToast(`Data ${pasien.nama} diisi otomatis. Lengkapi data yang masih kosong.`, "info");
        window.scrollTo({ top: 0, behavior: "smooth" });
      }

      function simpanData() {
        const nama = document.getElementById("namaPasien").value.trim();
        const noRM = document.getElementById("noRM").value.trim();
        const tglLahir = document.getElementById("tglLahir").value;
        const jenisKelamin = document.getElementById("jenisKelamin").value;
        const tglMasuk = document.getElementById("tglMasuk").value;
        const tglKeluar = document.getElementById("tglKeluar").value;
        const ruang = document.getElementById("ruang").value;
        const noTT = document.getElementById("noTT").value.trim();
        const kelas = document.getElementById("kelas").value;
        const caraMasuk = document.getElementById("caraMasuk").value;
        const pembiayaan = document.getElementById("pembiayaan").value;
        const status = document.getElementById("status").value;
        const diagnosa = document.getElementById("diagnosa").value.trim();
        const dokter = document.getElementById("dokter").value.trim();
        const berobatRefId = document.getElementById("berobatRefId").value;

        if (!nama || !noRM || !tglMasuk || !ruang || !noTT || !kelas || !caraMasuk || !pembiayaan || !status || !diagnosa || !dokter) {
          showToast("Semua field wajib diisi!", "error");
          return;
        }
        const pasien = {
          id: Date.now().toString(), nama, noRM, tglLahir, jenisKelamin,
          tglMasuk, tglKeluar, ruang, noTT, kelas, caraMasuk, pembiayaan, status,
          diagnosa, dokter, inputBy: loggedUser, inputAt: new Date().toISOString()
        };
        const data = getData();
        data.push(pasien);
        saveData(data);
        if (berobatRefId) {
          const berobat = getBerobatData();
          const idx = berobat.findIndex(p => p.id === berobatRefId);
          if (idx !== -1) { berobat[idx].sudahInput = true; localStorage.setItem(BEROBAT_KEY, JSON.stringify(berobat)); }
        }
        showToast("Data pasien rawat inap berhasil disimpan!", "success");
        resetForm();
        updateStats();
        populateRuangDropdowns();
        populateKelasDropdowns();
      }

      function resetForm() {
        ["namaPasien", "noRM", "noTT", "diagnosa", "dokter"].forEach(id => document.getElementById(id).value = "");
        document.getElementById("tglLahir").value = "";
        document.getElementById("jenisKelamin").value = "";
        document.getElementById("tglMasuk").value = todayStr;
        document.getElementById("tglKeluar").value = "";
        document.getElementById("ruang").value = "";
        document.getElementById("kelas").value = "";
        document.getElementById("caraMasuk").value = "";
        document.getElementById("pembiayaan").value = "";
        document.getElementById("status").value = "";
        document.getElementById("berobatRefId").value = "";
        document.getElementById("autofillBanner").style.display = "none";
      }

      function hapusData(id) {
        if (!confirm("Yakin ingin menghapus data ini?")) return;
        saveData(getData().filter(p => p.id !== id));
        renderTable();
        updateStats();
        showToast("Data berhasil dihapus", "success");
      }

      function bukaEdit(id) {
        const pasien = getData().find(p => p.id === id);
        if (!pasien) return;
        document.getElementById("editId").value = id;
        document.getElementById("editNama").value = pasien.nama;
        document.getElementById("editNoRM").value = pasien.noRM;
        document.getElementById("editTglMasuk").value = pasien.tglMasuk;
        document.getElementById("editTglKeluar").value = pasien.tglKeluar || "";
        document.getElementById("editRuang").value = pasien.ruang;
        document.getElementById("editNoTT").value = pasien.noTT;
        document.getElementById("editKelas").value = pasien.kelas;
        document.getElementById("editCaraMasuk").value = pasien.caraMasuk;
        document.getElementById("editPembiayaan").value = pasien.pembiayaan;
        document.getElementById("editStatus").value = pasien.status;
        document.getElementById("editDiagnosa").value = pasien.diagnosa;
        document.getElementById("editDokter").value = pasien.dokter;
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
        const tglMasuk = document.getElementById("editTglMasuk").value;
        const tglKeluar = document.getElementById("editTglKeluar").value;
        const ruang = document.getElementById("editRuang").value;
        const noTT = document.getElementById("editNoTT").value.trim();
        const kelas = document.getElementById("editKelas").value;
        const caraMasuk = document.getElementById("editCaraMasuk").value;
        const pembiayaan = document.getElementById("editPembiayaan").value;
        const status = document.getElementById("editStatus").value;
        const diagnosa = document.getElementById("editDiagnosa").value.trim();
        const dokter = document.getElementById("editDokter").value.trim();
        if (!nama || !noRM || !tglMasuk || !ruang || !noTT || !kelas || !caraMasuk || !pembiayaan || !status || !diagnosa || !dokter) {
          showToast("Semua field wajib diisi!", "error");
          return;
        }
        data[idx] = { ...data[idx], nama, noRM, tglMasuk, tglKeluar, ruang, noTT, kelas, caraMasuk, pembiayaan, status, diagnosa, dokter };
        saveData(data);
        tutupModal();
        renderTable();
        updateStats();
        showToast("Data berhasil diperbarui!", "success");
        setTimeout(() => {
          const row = document.getElementById(`row-${id}`);
          if (row) row.classList.add("highlight-row");
        }, 100);
      }

      function showSection(section) {
        const secs = ["Input", "Daftar", "Berobat", "AturRuang", "AturKelas"];
        secs.forEach(s => {
          const el = document.getElementById("section" + s);
          if (el) el.style.display = section === s.charAt(0).toLowerCase() + s.slice(1) ? "block" : "none";
        });
        const titles = {
          input: "<i class='bi bi-pencil-square'></i> Input Data Pasien Rawat Inap",
          daftar: "<i class='bi bi-list-check'></i> Daftar Pasien Rawat Inap",
          berobat: "<i class='bi bi-file-text'></i> Daftar Pasien Berobat",
          aturRuang: "<i class='bi bi-hospital'></i> Atur Ruang Bangsal",
          aturKelas: "<i class='bi bi-door-closed'></i> Atur Kelas Perawatan"
        };
        document.getElementById("sectionTitle").innerHTML = titles[section] || "";
        const navMap = { input: "nav-input", daftar: "nav-daftar", berobat: "nav-berobat", aturRuang: "nav-aturRuang", aturKelas: "nav-aturKelas" };
        Object.entries(navMap).forEach(([key, navId]) => {
          const el = document.getElementById(navId);
          if (el) el.classList.toggle("active", key === section);
        });
        if (section === "daftar") renderTable();
        if (section === "berobat") renderBerobat();
        if (section === "aturRuang") renderTabelRuang();
        if (section === "aturKelas") renderTabelKelas();
      }

      function showToast(msg, type) {
        const toast = document.getElementById("toast");
        toast.textContent = msg;
        toast.className = `toast-custom ${type} show`;
        setTimeout(() => toast.className = "toast-custom", 3000);
      }

      // ========== RUANG & KELAS STORAGE ==========
      const RUANG_KEY = "sensora_ruang";
      const KELAS_KEY = "sensora_kelas";
      const DEFAULT_RUANG = [
        { id: "r1", nama: "Dahlia", kapasitas: 20 }, { id: "r2", nama: "Melati", kapasitas: 20 },
        { id: "r3", nama: "Mawar", kapasitas: 18 }, { id: "r4", nama: "Anggrek", kapasitas: 16 },
        { id: "r5", nama: "ICU", kapasitas: 8 }, { id: "r6", nama: "IGD", kapasitas: 10 },
        { id: "r7", nama: "Perinatologi", kapasitas: 12 }, { id: "r8", nama: "VK / Bersalin", kapasitas: 10 }
      ];
      const DEFAULT_KELAS = [
        { id: "k1", nama: "Kelas I", ket: "" }, { id: "k2", nama: "Kelas II", ket: "" },
        { id: "k3", nama: "Kelas III", ket: "" }, { id: "k4", nama: "VIP", ket: "" }, { id: "k5", nama: "VVIP", ket: "" }
      ];
      function getRuangList() { const d = localStorage.getItem(RUANG_KEY); return d ? JSON.parse(d) : DEFAULT_RUANG; }
      function saveRuangList(list) { localStorage.setItem(RUANG_KEY, JSON.stringify(list)); }
      function getKelasList() { const d = localStorage.getItem(KELAS_KEY); return d ? JSON.parse(d) : DEFAULT_KELAS; }
      function saveKelasList(list) { localStorage.setItem(KELAS_KEY, JSON.stringify(list)); }

      function populateRuangDropdowns() {
        const list = getRuangList();
        ["ruang", "editRuang"].forEach(id => {
          const sel = document.getElementById(id);
          if (!sel) return;
          const cur = sel.value;
          sel.innerHTML = '<option value="">-- Pilih Ruang --</option>';
          list.forEach(r => { const o = document.createElement("option"); o.value = r.nama; o.textContent = r.nama; sel.appendChild(o); });
          sel.value = cur;
        });
      }

      function populateKelasDropdowns() {
        const list = getKelasList();
        ["kelas", "editKelas"].forEach(id => {
          const sel = document.getElementById(id);
          if (!sel) return;
          const cur = sel.value;
          sel.innerHTML = '<option value="">-- Pilih Kelas --</option>';
          list.forEach(k => { const o = document.createElement("option"); o.value = k.nama; o.textContent = k.nama; sel.appendChild(o); });
          sel.value = cur;
        });
      }

      function renderTabelRuang() {
        const list = getRuangList();
        const tbody = document.getElementById("tabelRuang");
        document.getElementById("ruangCount").textContent = "(" + list.length + " ruang)";
        if (!list.length) { tbody.innerHTML = '<tr><td colspan="4" class="empty-state">Belum ada data ruang</td></tr>'; return; }
        tbody.innerHTML = list.map((r, i) => `
          <tr>
            <td>${i + 1}</td><td><strong>${r.nama}</strong></td>
            <td class="text-center">${r.kapasitas || "-"}</td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-edit-sm" onclick="editRuangItem('${r.id}')"><i class="bi bi-pencil"></i> Edit</button>
                <button class="btn-del-sm" onclick="hapusRuang('${r.id}')"><i class="bi bi-trash"></i> Hapus</button>
              </div>
            </td>
          </tr>
        `).join("");
      }

      function simpanRuang() {
        const nama = document.getElementById("inputNamaRuang").value.trim();
        const kap = parseInt(document.getElementById("inputKapasitasRuang").value) || 0;
        const editId = document.getElementById("editRuangId").value;
        if (!nama) { showToast("Nama ruang wajib diisi!", "error"); return; }
        const list = getRuangList();
        if (editId) {
          const idx = list.findIndex(r => r.id === editId);
          if (idx !== -1) { list[idx].nama = nama; list[idx].kapasitas = kap; }
          document.getElementById("editRuangId").value = "";
          document.getElementById("titleFormRuang").innerHTML = "<i class='bi bi-hospital'></i> Tambah Ruang Bangsal";
          showToast("Ruang berhasil diperbarui!", "success");
        } else {
          if (list.find(r => r.nama.toLowerCase() === nama.toLowerCase())) { showToast("Nama ruang sudah ada!", "error"); return; }
          list.push({ id: "r" + Date.now(), nama, kapasitas: kap });
          showToast("Ruang berhasil ditambahkan!", "success");
        }
        saveRuangList(list);
        resetFormRuang();
        renderTabelRuang();
        populateRuangDropdowns();
      }

      function editRuangItem(id) {
        const r = getRuangList().find(x => x.id === id);
        if (!r) return;
        document.getElementById("inputNamaRuang").value = r.nama;
        document.getElementById("inputKapasitasRuang").value = r.kapasitas || "";
        document.getElementById("editRuangId").value = id;
        document.getElementById("titleFormRuang").innerHTML = "<i class='bi bi-pencil-square'></i> Edit Ruang Bangsal";
        window.scrollTo({ top: 0, behavior: "smooth" });
      }

      function hapusRuang(id) {
        if (!confirm("Yakin ingin menghapus ruang ini?")) return;
        saveRuangList(getRuangList().filter(r => r.id !== id));
        renderTabelRuang();
        populateRuangDropdowns();
        showToast("Ruang berhasil dihapus", "success");
      }

      function resetFormRuang() {
        document.getElementById("inputNamaRuang").value = "";
        document.getElementById("inputKapasitasRuang").value = "";
        document.getElementById("editRuangId").value = "";
        document.getElementById("titleFormRuang").innerHTML = "<i class='bi bi-hospital'></i> Tambah Ruang Bangsal";
      }

      function renderTabelKelas() {
        const list = getKelasList();
        const tbody = document.getElementById("tabelKelas");
        document.getElementById("kelasCount").textContent = "(" + list.length + " kelas)";
        if (!list.length) { tbody.innerHTML = '<tr><td colspan="4" class="empty-state">Belum ada data kelas</td></tr>'; return; }
        tbody.innerHTML = list.map((k, i) => `
          <tr>
            <td>${i + 1}</td><td><strong>${k.nama}</strong></td>
            <td class="text-muted">${k.ket || "-"}</td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-edit-sm" onclick="editKelasItem('${k.id}')"><i class="bi bi-pencil"></i> Edit</button>
                <button class="btn-del-sm" onclick="hapusKelas('${k.id}')"><i class="bi bi-trash"></i> Hapus</button>
              </div>
            </td>
          </tr>
        `).join("");
      }

      function simpanKelas() {
        const nama = document.getElementById("inputNamaKelas").value.trim();
        const ket = document.getElementById("inputKetKelas").value.trim();
        const editId = document.getElementById("editKelasId").value;
        if (!nama) { showToast("Nama kelas wajib diisi!", "error"); return; }
        const list = getKelasList();
        if (editId) {
          const idx = list.findIndex(k => k.id === editId);
          if (idx !== -1) { list[idx].nama = nama; list[idx].ket = ket; }
          document.getElementById("editKelasId").value = "";
          document.getElementById("titleFormKelas").innerHTML = "<i class='bi bi-door-closed'></i> Tambah Kelas Perawatan";
          showToast("Kelas berhasil diperbarui!", "success");
        } else {
          if (list.find(k => k.nama.toLowerCase() === nama.toLowerCase())) { showToast("Nama kelas sudah ada!", "error"); return; }
          list.push({ id: "k" + Date.now(), nama, ket });
          showToast("Kelas berhasil ditambahkan!", "success");
        }
        saveKelasList(list);
        resetFormKelas();
        renderTabelKelas();
        populateKelasDropdowns();
      }

      function editKelasItem(id) {
        const k = getKelasList().find(x => x.id === id);
        if (!k) return;
        document.getElementById("inputNamaKelas").value = k.nama;
        document.getElementById("inputKetKelas").value = k.ket || "";
        document.getElementById("editKelasId").value = id;
        document.getElementById("titleFormKelas").innerHTML = "<i class='bi bi-pencil-square'></i> Edit Kelas Perawatan";
        window.scrollTo({ top: 0, behavior: "smooth" });
      }

      function hapusKelas(id) {
        if (!confirm("Yakin ingin menghapus kelas ini?")) return;
        saveKelasList(getKelasList().filter(k => k.id !== id));
        renderTabelKelas();
        populateKelasDropdowns();
        showToast("Kelas berhasil dihapus", "success");
      }

      function resetFormKelas() {
        document.getElementById("inputNamaKelas").value = "";
        document.getElementById("inputKetKelas").value = "";
        document.getElementById("editKelasId").value = "";
        document.getElementById("titleFormKelas").innerHTML = "<i class='bi bi-door-closed'></i> Tambah Kelas Perawatan";
      }

      function logout() {
        localStorage.removeItem("role");
        localStorage.removeItem("loggedUser");
        window.location.href = "/pilihakses";
      }

      populateRuangDropdowns();
      populateKelasDropdowns();
      updateStats();
    </script>
  </body>
</html>