<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SENSORA - Petugas Pelaporan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <style>
      :root {
        --primary: #0ea5e9;
        --primary-dark: #0284c7;
        --primary-light: #e0f2fe;
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --purple: #8b5cf6;
        --orange: #f97316;
        --teal: #14b8a6;
        --bg: #f1f5f9;
        --card: #ffffff;
        --text: #1e1e2e;
        --muted: #64748b;
        --border: #e2e8f0;
      }
      body { font-family: "Nunito", sans-serif; background: var(--bg); color: var(--text); }

      /* SIDEBAR */
      .sidebar {
        position:fixed; top:0; left:0; width:240px; height:100vh;
        background: var(--primary-dark);
        display:flex; flex-direction:column;
        z-index:100; box-shadow:4px 0 20px rgba(2,132,199,.2);
      }
      .sidebar-brand { padding:28px 24px 20px; border-bottom:1px solid rgba(255,255,255,.15); }
      .sidebar-brand .brand { font-size:22px; font-weight:800; color:#fff; letter-spacing:3px; font-style:italic; }
      .sidebar-brand .brand-sub { font-size:10px; color:rgba(255,255,255,.6); letter-spacing:1px; text-transform:uppercase; margin-top:2px; }
      .sidebar-nav { flex:1; padding:20px 12px; display:flex; flex-direction:column; gap:4px; overflow-y:auto; }
      .nav-item {
        display:flex; align-items:center; gap:12px;
        padding:12px 16px; border-radius:12px;
        color:rgba(255,255,255,.7); font-size:14px; font-weight:600;
        cursor:pointer; transition:all .2s; text-decoration:none;
        border:none; background:transparent; width:100%; text-align:left;
        font-family:"Nunito",sans-serif;
      }
      .nav-item:hover, .nav-item.active { background:rgba(255,255,255,.15); color:#fff; }
      .nav-item .icon { font-size:18px; width:24px; text-align:center; }
      .nav-section-label { font-size:10px; font-weight:800; color:rgba(255,255,255,.35); text-transform:uppercase; letter-spacing:1.5px; padding:12px 16px 4px; }
      .sidebar-footer { padding:16px 12px; border-top:1px solid rgba(255,255,255,.15); }
      .user-info { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; background:rgba(255,255,255,.1); margin-bottom:8px; }
      .user-avatar { width:36px; height:36px; border-radius:10px; background:rgba(255,255,255,.2); display:flex; align-items:center; justify-content:center; font-size:16px; }
      .user-name { font-size:12px; font-weight:700; color:#fff; }
      .user-role { font-size:10px; color:rgba(255,255,255,.6); }
      .logout-btn { width:100%; padding:10px; border:none; border-radius:10px; background:rgba(239,68,68,.15); color:#fca5a5; font-family:"Nunito",sans-serif; font-weight:700; font-size:13px; cursor:pointer; transition:.2s; }
      .logout-btn:hover { background:rgba(239,68,68,.3); color:#fff; }

      /* MAIN */
      .main { margin-left:240px; min-height:100vh; padding:32px; }

      /* STAT ICON */
      .stat-icon { width:48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:22px; flex-shrink:0; }
      .stat-icon.masuk { background:#dbeafe; }
      .stat-icon.keluar { background:#dcfce7; }
      .stat-icon.pindah { background:#fef9c3; }
      .stat-icon.total { background:#f3e8ff; }
      .stat-num { font-size:26px; font-weight:800; line-height:1; }
      .stat-label { font-size:12px; color:var(--muted); font-weight:600; margin-top:3px; }

      /* BADGES */
      .badge-masuk { background:#dbeafe; color:#1d4ed8; }
      .badge-keluar { background:#dcfce7; color:#15803d; }
      .badge-pindah { background:#fef9c3; color:#92400e; }
      .badge-ok { background:#dcfce7; color:#15803d; }
      .badge-warn { background:#fef9c3; color:#92400e; }
      .badge-bad { background:#fee2e2; color:#dc2626; }
      .badge-na { background:#f1f5f9; color:var(--muted); }

      .empty-state { text-align:center; padding:40px; color:var(--muted); font-size:14px; }

      /* SPM CARDS */
      .spm-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:14px; margin-bottom:24px; }
      .spm-card {
        background:var(--card); border-radius:18px; padding:20px 16px 18px;
        box-shadow:0 2px 12px rgba(0,0,0,.07); position:relative; overflow:hidden;
        transition:transform .2s; display:flex; flex-direction:column; align-items:center; text-align:center; gap:6px;
      }
      .spm-card:hover { transform:translateY(-3px); }
      .spm-card::after { content:""; position:absolute; top:0; left:0; right:0; height:5px; border-radius:18px 18px 0 0; }
      .spm-card.bor::after { background:var(--primary); }
      .spm-card.avlos::after { background:var(--success); }
      .spm-card.bto::after { background:var(--warning); }
      .spm-card.toi::after { background:var(--purple); }
      .spm-card.ndr::after { background:var(--orange); }
      .spm-icon { font-size:28px; margin-top:6px; }
      .spm-abbr { font-size:20px; font-weight:800; color:var(--text); line-height:1; }
      .spm-name { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.6px; color:var(--muted); }
      .spm-divider { width:100%; height:1px; background:var(--border); margin:4px 0; }
      .spm-value { font-size:28px; font-weight:800; line-height:1; }
      .spm-card.bor .spm-value { color:var(--primary); }
      .spm-card.avlos .spm-value { color:var(--success); }
      .spm-card.bto .spm-value { color:var(--warning); }
      .spm-card.toi .spm-value { color:var(--purple); }
      .spm-card.ndr .spm-value { color:var(--orange); }
      .spm-unit { font-size:11px; color:var(--muted); font-weight:700; }
      .spm-standar { font-size:11px; font-weight:700; color:var(--muted); margin-top:2px; }
      .spm-badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:800; margin-top:4px; }
      .status-ok { background:#dcfce7; color:#15803d; }
      .status-warn { background:#fef9c3; color:#92400e; }
      .status-bad { background:#fee2e2; color:#dc2626; }
      .status-na { background:#f1f5f9; color:var(--muted); }

      /* RUMUS */
      .rumus-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px; }
      .rumus-card { background:var(--card); border-radius:16px; padding:18px 20px; box-shadow:0 2px 12px rgba(0,0,0,.06); border-left:4px solid var(--border); }
      .rumus-card.bor-c { border-color:var(--primary); }
      .rumus-card.avlos-c { border-color:var(--success); }
      .rumus-card.bto-c { border-color:var(--warning); }
      .rumus-card.toi-c { border-color:var(--purple); }
      .rumus-card.ndr-c { border-color:var(--orange); }
      .rumus-card.los-c { border-color:var(--teal); }
      .rumus-nama { font-size:12px; font-weight:800; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px; }
      .rumus-kepanjangan { font-size:13px; font-weight:700; color:var(--text); margin-bottom:10px; }
      .rumus-formula { background:var(--bg); border-radius:8px; padding:8px 12px; font-size:12px; font-weight:700; color:var(--text); font-style:italic; margin-bottom:8px; line-height:1.6; }
      .rumus-standar { font-size:11px; font-weight:700; color:var(--muted); }
      .rumus-standar strong { color:var(--text); }

      /* LEGEND */
      .legend { display:flex; gap:14px; flex-wrap:wrap; }
      .legend-item { display:flex; align-items:center; gap:6px; font-size:12px; font-weight:700; color:var(--muted); }
      .legend-dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; }

      /* TOOLTIP */
      .info-btn { display:inline-flex; align-items:center; justify-content:center; width:18px; height:18px; border-radius:50%; background:var(--border); color:var(--muted); font-size:10px; font-weight:800; cursor:pointer; position:relative; }
      .info-btn:hover .ttip { display:block; }
      .ttip { display:none; position:absolute; bottom:calc(100% + 8px); left:50%; transform:translateX(-50%); background:#1e1e2e; color:#fff; padding:8px 12px; border-radius:10px; font-size:11px; font-weight:600; white-space:nowrap; z-index:99; line-height:1.5; }
      .ttip::after { content:""; position:absolute; top:100%; left:50%; transform:translateX(-50%); border:5px solid transparent; border-top-color:#1e1e2e; }

      /* CHART */
      .chart-container { position:relative; height:260px; }
      .chart-container.tall { height:280px; }

      /* TOAST */
      .toast-custom { position:fixed; top:24px; right:24px; padding:14px 22px; border-radius:12px; font-size:14px; font-weight:700; color:#fff; z-index:9999; opacity:0; transform:translateY(-10px); transition:all .3s; pointer-events:none; }
      .toast-custom.show { opacity:1; transform:translateY(0); }
      .toast-custom.success { background:var(--success); }
      .toast-custom.error { background:var(--danger); }

      /* FILTER GROUP */
      .filter-label { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; }

      @media print {
        .sidebar, .filter-bar, .btn-print { display:none !important; }
        .main { margin-left:0; padding:16px; }
        body { background:white; }
      }
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
        <div class="nav-section-label">Pelaporan</div>
        <button class="nav-item active" id="nav-rekap" onclick="showSection('rekap')">
          <span class="icon">📊</span> Rekap Harian
        </button>
        <div class="nav-section-label">Analitik</div>
        <button class="nav-item" id="nav-spm" onclick="showSection('spm')">
          <span class="icon">🏥</span> Indikator SPM
        </button>
      </nav>
      <div class="sidebar-footer">
        <div class="user-info">
          <div class="user-avatar">📋</div>
          <div>
            <div class="user-name" id="sidebarUser">-</div>
            <div class="user-role">Petugas Pelaporan</div>
          </div>
        </div>
        <button class="logout-btn" onclick="logout()">🚪 Keluar</button>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">

      <!-- SECTION: REKAP HARIAN -->
      <div id="sectionRekap">
        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
          <div>
            <div class="fw-bold fs-5">📊 Rekap Harian</div>
            <div class="text-muted small fw-semibold" id="pageDate"></div>
          </div>
          <div class="d-flex align-items-center gap-2 flex-wrap filter-bar">
            <input type="date" class="form-control" style="width:160px;" id="r-filterTgl" />
            <select class="form-select" style="width:180px;" id="r-filterRuang">
              <option value="">Semua Ruang</option>
              <option>Dahlia</option><option>Melati</option><option>Mawar</option>
              <option>Anggrek</option><option>ICU</option><option>IGD</option>
              <option>Perinatologi</option><option>VK / Bersalin</option>
            </select>
            <button class="btn btn-primary fw-bold" onclick="applyFilterRekap()">🔍 Tampilkan</button>
            <button class="btn btn-print fw-bold" style="background:#8b5cf6;color:#fff;" onclick="window.print()">🖨️ Cetak</button>
            <button class="btn btn-success fw-bold" onclick="exportCSV()">📥 Export CSV</button>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
              <div class="stat-icon masuk">🏥</div>
              <div><div class="stat-num" id="r-statMasuk">0</div><div class="stat-label">Pasien Masuk</div></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
              <div class="stat-icon keluar">✅</div>
              <div><div class="stat-num" id="r-statKeluar">0</div><div class="stat-label">Pasien Keluar</div></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
              <div class="stat-icon pindah">🔄</div>
              <div><div class="stat-num" id="r-statPindah">0</div><div class="stat-label">Pindah Ruang</div></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
              <div class="stat-icon total">📈</div>
              <div><div class="stat-num" id="r-statTotal">0</div><div class="stat-label">Total Data</div></div>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <h6 class="fw-bold mb-3">📊 Rekap Per Ruang / Bangsal</h6>
          <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size:13px;">
              <thead class="table-light">
                <tr>
                  <th>No</th><th>Ruang / Bangsal</th>
                  <th>Pasien Masuk</th><th>Pasien Keluar</th>
                  <th>Pindah Ruang</th><th>Total</th>
                </tr>
              </thead>
              <tbody id="r-tabelRekap">
                <tr><td colspan="6" class="empty-state">Pilih tanggal dan klik Tampilkan</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SECTION: INDIKATOR SPM -->
      <div id="sectionSpm" style="display:none;">
        <div class="d-flex align-items-start justify-content-between mb-4">
          <div>
            <div class="fw-bold fs-5">🏥 Indikator SPM Rawat Inap</div>
            <div class="text-muted small fw-semibold" id="pageDate4"></div>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <div class="row g-3 align-items-end">
            <div class="col-auto">
              <label class="filter-label">Dari Tanggal</label>
              <input type="date" class="form-control" id="spm-dari" />
            </div>
            <div class="col-auto d-flex align-items-end pb-1">
              <span class="text-muted fw-bold">s/d</span>
            </div>
            <div class="col-auto">
              <label class="filter-label">Sampai Tanggal</label>
              <input type="date" class="form-control" id="spm-sampai" />
            </div>
            <div class="col-auto">
              <label class="filter-label">Ruang / Bangsal</label>
              <select class="form-select" id="spm-ruang" style="width:180px;">
                <option value="">Semua Ruang</option>
                <option>Dahlia</option><option>Melati</option><option>Mawar</option>
                <option>Anggrek</option><option>ICU</option><option>IGD</option>
                <option>Perinatologi</option><option>VK / Bersalin</option>
              </select>
            </div>
            <div class="col-auto">
              <label class="filter-label">Jumlah Hari Periode</label>
              <input type="number" class="form-control" id="spm-hari" min="1" max="366" value="30" style="width:100px;" />
            </div>
            <div class="col-auto">
              <label class="filter-label">Total TT Tersedia</label>
              <input type="number" class="form-control" id="spm-tt" min="1" max="9999" value="114" style="width:110px;" />
            </div>
            <div class="col-auto d-flex gap-2">
              <button class="btn btn-primary fw-bold" onclick="hitungSPM()">🔍 Hitung Indikator</button>
              <button class="btn fw-bold btn-print" style="background:#8b5cf6;color:#fff;" onclick="window.print()">🖨️ Cetak</button>
            </div>
          </div>
        </div>

        <div class="alert alert-info border-start border-primary border-4 rounded-3 mb-4" style="background:linear-gradient(135deg,#eff6ff,#e0f2fe);">
          <div class="fw-bold text-primary mb-1">ℹ️ Catatan Perhitungan</div>
          <div class="small" style="color:#1e40af; line-height:1.7;">
            Indikator dihitung dari data pasien yang tersimpan di sistem. Pastikan <strong>jumlah hari periode</strong> dan <strong>total tempat tidur tersedia</strong> sesuai kondisi aktual. Standar baku mengacu pada <strong>Depkes RI &amp; Barber-Johnson</strong>.
          </div>
        </div>

        <!-- 5 SPM CARDS -->
        <div class="spm-grid mb-4">
          <div class="spm-card bor">
            <div class="spm-icon">🛏️</div>
            <div class="spm-abbr">BOR</div>
            <div class="spm-name">Bed Occupancy Rate</div>
            <div class="spm-divider"></div>
            <div class="spm-value" id="v-bor">—</div>
            <div class="spm-unit">%</div>
            <div class="spm-standar">Standar: 60 – 85%</div>
            <span class="spm-badge status-na" id="s-bor">Belum dihitung</span>
            <svg style="display:none"><circle id="g-bor"/></svg>
          </div>
          <div class="spm-card avlos">
            <div class="spm-icon">📅</div>
            <div class="spm-abbr">AVLOS</div>
            <div class="spm-name">Avg. Length of Stay</div>
            <div class="spm-divider"></div>
            <div class="spm-value" id="v-avlos">—</div>
            <div class="spm-unit">hari</div>
            <div class="spm-standar">Standar: 6 – 9 hari</div>
            <span class="spm-badge status-na" id="s-avlos">Belum dihitung</span>
            <svg style="display:none"><circle id="g-avlos"/></svg>
          </div>
          <div class="spm-card bto">
            <div class="spm-icon">🔁</div>
            <div class="spm-abbr">BTO</div>
            <div class="spm-name">Bed Turn Over</div>
            <div class="spm-divider"></div>
            <div class="spm-value" id="v-bto">—</div>
            <div class="spm-unit">kali / TT / periode</div>
            <div class="spm-standar">Standar: 40 – 50/tahun</div>
            <span class="spm-badge status-na" id="s-bto">Belum dihitung</span>
            <svg style="display:none"><circle id="g-bto"/></svg>
          </div>
          <div class="spm-card toi">
            <div class="spm-icon">⏱️</div>
            <div class="spm-abbr">TOI</div>
            <div class="spm-name">Turn Over Interval</div>
            <div class="spm-divider"></div>
            <div class="spm-value" id="v-toi">—</div>
            <div class="spm-unit">hari</div>
            <div class="spm-standar">Standar: 1 – 3 hari</div>
            <span class="spm-badge status-na" id="s-toi">Belum dihitung</span>
            <svg style="display:none"><circle id="g-toi"/></svg>
          </div>
          <div class="spm-card ndr">
            <div class="spm-icon">📉</div>
            <div class="spm-abbr">NDR</div>
            <div class="spm-name">Net Death Rate</div>
            <div class="spm-divider"></div>
            <div class="spm-value" id="v-ndr">—</div>
            <div class="spm-unit">‰</div>
            <div class="spm-standar">Standar: &lt; 25‰</div>
            <span class="spm-badge status-na" id="s-ndr">Belum dihitung</span>
            <svg style="display:none"><circle id="g-ndr"/></svg>
          </div>
        </div>

        <!-- RUMUS GRID -->
        <div class="rumus-grid">
          <div class="rumus-card bor-c">
            <div class="rumus-nama">BOR</div>
            <div class="rumus-kepanjangan">Bed Occupancy Rate</div>
            <div class="rumus-formula">(Σ Hari Perawatan ÷ (TT × Hari)) × 100%</div>
            <div class="rumus-standar">Standar Depkes: <strong>60% – 85%</strong><br>Optimal Barber-Johnson: <strong>75% – 85%</strong></div>
          </div>
          <div class="rumus-card avlos-c">
            <div class="rumus-nama">AVLOS / ALOS</div>
            <div class="rumus-kepanjangan">Average Length of Stay</div>
            <div class="rumus-formula">Σ Lama Dirawat ÷ Σ Pasien Keluar</div>
            <div class="rumus-standar">Standar Depkes: <strong>6 – 9 hari</strong><br>Efisien: <strong>&lt; 9 hari</strong></div>
          </div>
          <div class="rumus-card bto-c">
            <div class="rumus-nama">BTO</div>
            <div class="rumus-kepanjangan">Bed Turn Over</div>
            <div class="rumus-formula">Σ Pasien Keluar ÷ Σ Tempat Tidur</div>
            <div class="rumus-standar">Standar Depkes: <strong>40 – 50 kali/tahun</strong></div>
          </div>
          <div class="rumus-card toi-c">
            <div class="rumus-nama">TOI</div>
            <div class="rumus-kepanjangan">Turn Over Interval</div>
            <div class="rumus-formula">(TT × Hari − Σ Hari Perawatan) ÷ Σ Pasien Keluar</div>
            <div class="rumus-standar">Standar Depkes: <strong>1 – 3 hari</strong></div>
          </div>
          <div class="rumus-card ndr-c">
            <div class="rumus-nama">NDR</div>
            <div class="rumus-kepanjangan">Net Death Rate</div>
            <div class="rumus-formula">(Meninggal &gt;48 jam ÷ Σ Keluar) × 1000</div>
            <div class="rumus-standar">Standar Depkes: <strong>&lt; 25‰</strong></div>
          </div>
          <div class="rumus-card los-c">
            <div class="rumus-nama">LOS</div>
            <div class="rumus-kepanjangan">Length of Stay (per pasien)</div>
            <div class="rumus-formula">Tanggal Keluar − Tanggal Masuk (hari)</div>
            <div class="rumus-standar">Dasar perhitungan AVLOS &amp; TOI</div>
          </div>
        </div>

        <!-- TABEL SPM PER RUANG -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
            <div>
              <h6 class="fw-bold mb-1">🏥 Indikator SPM Per Ruang / Bangsal</h6>
              <div class="text-muted small fw-semibold">Detail BOR, AVLOS, BTO, dan TOI per unit perawatan</div>
            </div>
            <div class="legend">
              <div class="legend-item"><div class="legend-dot" style="background:#22c55e"></div> Sesuai standar</div>
              <div class="legend-item"><div class="legend-dot" style="background:#f59e0b"></div> Perlu perhatian</div>
              <div class="legend-item"><div class="legend-dot" style="background:#ef4444"></div> Di luar standar</div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size:13px;">
              <thead class="table-light">
                <tr>
                  <th>Ruang</th><th>TT</th>
                  <th class="text-center">Masuk</th><th class="text-center">Keluar</th><th class="text-center">Hari Rawat</th>
                  <th class="text-center">BOR (%) <span class="info-btn">i<div class="ttip">(Hari Rawat ÷ (TT × Hari)) × 100<br>Standar: 60–85%</div></span></th>
                  <th class="text-center">AVLOS (hr) <span class="info-btn">i<div class="ttip">Σ LOS ÷ Σ Keluar<br>Standar: 6–9 hari</div></span></th>
                  <th class="text-center">BTO <span class="info-btn">i<div class="ttip">Σ Keluar ÷ Σ TT<br>Standar: 40–50/tahun</div></span></th>
                  <th class="text-center">TOI (hr) <span class="info-btn">i<div class="ttip">(TT × Hari − Hari Rawat) ÷ Σ Keluar<br>Standar: 1–3 hari</div></span></th>
                  <th class="text-center">Status BOR</th>
                </tr>
              </thead>
              <tbody id="spm-tabel">
                <tr><td colspan="10" class="empty-state">Klik <strong>Hitung Indikator</strong> untuk melihat hasil</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- CHART BOR -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
          <h6 class="fw-bold mb-1">📊 Grafik BOR Per Ruang</h6>
          <div class="text-muted small fw-semibold mb-3">Perbandingan tingkat hunian antar unit (garis = batas standar)</div>
          <div class="chart-container tall">
            <canvas id="spm-chartBOR"></canvas>
          </div>
        </div>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
              <h6 class="fw-bold mb-3">📅 AVLOS Per Ruang (hari)</h6>
              <div class="chart-container">
                <canvas id="spm-chartAVLOS"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
              <h6 class="fw-bold mb-3">🔄 TOI Per Ruang (hari)</h6>
              <div class="chart-container">
                <canvas id="spm-chartTOI"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast-custom" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const STORAGE_KEY = "sensora_pasien";
      const RUANG_LIST = ["Dahlia","Melati","Mawar","Anggrek","ICU","IGD","Perinatologi","VK / Bersalin"];
      const KAPASITAS = { Dahlia:20, Melati:20, Mawar:18, Anggrek:16, ICU:8, IGD:10, Perinatologi:12, "VK / Bersalin":10 };

      const role = localStorage.getItem("role");
      const loggedUser = localStorage.getItem("loggedUser");
      if (!role || !loggedUser || role !== "pelaporan") {
        window.location.href = "pilihakses.html";
      }
      document.getElementById("sidebarUser").textContent = loggedUser ? loggedUser.split("@")[0] : "-";

      const today = new Date();
      const todayStr = today.toISOString().split("T")[0];
      const firstDay = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split("T")[0];
      const opts = { weekday:"long", year:"numeric", month:"long", day:"numeric" };
      const tglStr = today.toLocaleDateString("id-ID", opts);
      ["pageDate","pageDate4"].forEach(id => { const el = document.getElementById(id); if (el) el.textContent = tglStr; });

      document.getElementById("r-filterTgl").value = todayStr;
      document.getElementById("spm-dari").value = firstDay;
      document.getElementById("spm-sampai").value = todayStr;

      function updateHariSPM() {
        const dari = new Date(document.getElementById("spm-dari").value);
        const sampai = new Date(document.getElementById("spm-sampai").value);
        if (dari && sampai && sampai >= dari) {
          document.getElementById("spm-hari").value = Math.round((sampai - dari) / (1000*60*60*24)) + 1;
        }
      }
      document.getElementById("spm-dari").addEventListener("change", updateHariSPM);
      document.getElementById("spm-sampai").addEventListener("change", updateHariSPM);
      updateHariSPM();

      function getData() { return JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]"); }

      function showToast(msg, type) {
        const t = document.getElementById("toast");
        t.textContent = msg;
        t.className = `toast-custom ${type} show`;
        setTimeout(() => t.className = "toast-custom", 3000);
      }

      function hitungLOS(p) {
        if (!p.tglKeluar || !p.tglMasuk) return 0;
        const los = Math.round((new Date(p.tglKeluar) - new Date(p.tglMasuk)) / (1000*60*60*24));
        return los > 0 ? los : 1;
      }

      function showSection(name) {
        const sectionMap = { rekap:"sectionRekap", spm:"sectionSpm" };
        Object.entries(sectionMap).forEach(([key, divId]) => {
          const el = document.getElementById(divId);
          if (el) el.style.display = key === name ? "block" : "none";
          const nav = document.getElementById("nav-" + key);
          if (nav) nav.classList.toggle("active", key === name);
        });
        if (name === "spm") hitungSPM();
      }

      function getFilteredByDate(tgl, ruang) {
        let data = getData();
        if (tgl) data = data.filter(p => p.tglMasuk === tgl || p.tglKeluar === tgl);
        if (ruang) data = data.filter(p => p.ruang === ruang);
        return data;
      }

      function applyFilterRekap() {
        const tgl = document.getElementById("r-filterTgl").value;
        const ruang = document.getElementById("r-filterRuang").value;
        const data = getFilteredByDate(tgl, ruang);
        document.getElementById("r-statMasuk").textContent = data.filter(p => p.status==="masuk").length;
        document.getElementById("r-statKeluar").textContent = data.filter(p => p.status==="keluar").length;
        document.getElementById("r-statPindah").textContent = data.filter(p => p.status==="pindah").length;
        document.getElementById("r-statTotal").textContent = data.length;
        const rekap = {};
        RUANG_LIST.forEach(r => rekap[r] = { masuk:0, keluar:0, pindah:0 });
        data.forEach(p => {
          if (!rekap[p.ruang]) rekap[p.ruang] = { masuk:0, keluar:0, pindah:0 };
          rekap[p.ruang][p.status]++;
        });
        const rows = Object.entries(rekap).filter(([_,v]) => v.masuk+v.keluar+v.pindah > 0);
        const tbody = document.getElementById("r-tabelRekap");
        tbody.innerHTML = rows.length
          ? rows.map(([r,v],i) => `<tr><td>${i+1}</td><td><strong>${r}</strong></td><td>${v.masuk}</td><td>${v.keluar}</td><td>${v.pindah}</td><td><strong>${v.masuk+v.keluar+v.pindah}</strong></td></tr>`).join("")
          : '<tr><td colspan="6" class="empty-state">Tidak ada data untuk filter yang dipilih</td></tr>';
      }

      function exportCSV() {
        const tgl = document.getElementById("r-filterTgl").value;
        const ruang = document.getElementById("r-filterRuang").value;
        const data = getFilteredByDate(tgl, ruang);
        if (!data.length) { showToast("Tidak ada data untuk diekspor!", "error"); return; }
        const header = ["No","No.RM","Nama","Tgl Masuk","Tgl Keluar","Ruang","No.TT","Kelas","Cara Masuk","Pembiayaan","Diagnosa","Dokter","Status"];
        const rows = data.map((p,i) => [i+1,p.noRM,p.nama,p.tglMasuk,p.tglKeluar||"",p.ruang,p.noTT,p.kelas,p.caraMasuk,p.pembiayaan,p.diagnosa,p.dokter,p.status]);
        const csv = [header,...rows].map(r => r.map(v => `"${v}"`).join(",")).join("\n");
        const a = document.createElement("a");
        a.href = "data:text/csv;charset=utf-8,\uFEFF" + encodeURIComponent(csv);
        a.download = `rekap_sensora_${tgl||"semua"}.csv`;
        a.click();
        showToast("CSV berhasil diunduh!", "success");
      }

      let spmChartBOR, spmChartAVLOS, spmChartTOI;

      function gaugeUpdate(id, val, max) {
        const C = 2 * Math.PI * 34;
        const el = document.getElementById(id);
        if (el) el.setAttribute("stroke-dasharray", `${Math.min(val/max,1)*C} ${C}`);
      }

      function hitungSPM() {
        const dari = document.getElementById("spm-dari").value;
        const sampai = document.getElementById("spm-sampai").value;
        const fRuang = document.getElementById("spm-ruang").value;
        const hari = parseInt(document.getElementById("spm-hari").value) || 30;
        const ttTotal = parseInt(document.getElementById("spm-tt").value) || 114;
        if (!dari || !sampai) { showToast("Pilih rentang tanggal terlebih dahulu!", "error"); return; }
        let data = getData().filter(p => p.tglMasuk >= dari && p.tglMasuk <= sampai);
        if (fRuang) data = data.filter(p => p.ruang === fRuang);
        const pKeluar = data.filter(p => p.status === "keluar");
        const jKeluar = pKeluar.length;
        const totalHR = pKeluar.reduce((s,p) => s + hitungLOS(p), 0);
        const BOR = ttTotal > 0 && hari > 0 ? parseFloat(((totalHR/(ttTotal*hari))*100).toFixed(1)) : null;
        const AVLOS = jKeluar > 0 ? parseFloat((totalHR/jKeluar).toFixed(1)) : null;
        const BTO = ttTotal > 0 && jKeluar > 0 ? parseFloat((jKeluar/ttTotal).toFixed(2)) : null;
        const TOI = jKeluar > 0 ? parseFloat(((ttTotal*hari-totalHR)/jKeluar).toFixed(1)) : null;
        document.getElementById("v-bor").textContent = BOR !== null ? BOR+"%" : "—";
        document.getElementById("v-avlos").textContent = AVLOS !== null ? AVLOS+" hr" : "—";
        document.getElementById("v-bto").textContent = BTO !== null ? BTO : "—";
        document.getElementById("v-toi").textContent = TOI !== null ? TOI+" hr" : "—";
        document.getElementById("v-ndr").textContent = "0.0‰";
        gaugeUpdate("g-bor", BOR !== null ? BOR : 0, 100);
        gaugeUpdate("g-avlos", AVLOS !== null ? Math.min(AVLOS,14) : 0, 14);
        gaugeUpdate("g-bto", BTO !== null ? Math.min(BTO,5) : 0, 5);
        gaugeUpdate("g-toi", TOI !== null ? Math.min(Math.abs(TOI),10) : 0, 10);
        gaugeUpdate("g-ndr", 0, 100);
        function setStatus(elId, cls, txt) { const el=document.getElementById(elId); el.className="spm-badge "+cls; el.textContent=txt; }
        if (BOR !== null) {
          if (BOR>=60&&BOR<=85) setStatus("s-bor","status-ok","✅ Sesuai Standar");
          else if (BOR<60) setStatus("s-bor","status-warn","⚠️ Di Bawah Standar");
          else setStatus("s-bor","status-bad","❌ Di Atas Standar");
        } else setStatus("s-bor","status-na","N/A");
        if (AVLOS !== null) {
          if (AVLOS>=6&&AVLOS<=9) setStatus("s-avlos","status-ok","✅ Sesuai Standar");
          else if (AVLOS>0) setStatus("s-avlos","status-warn","⚠️ Di Luar Standar");
          else setStatus("s-avlos","status-na","N/A");
        } else setStatus("s-avlos","status-na","N/A");
        if (BTO !== null) setStatus("s-bto","status-na",BTO+" kali / periode");
        else setStatus("s-bto","status-na","N/A");
        if (TOI !== null) {
          if (TOI>=1&&TOI<=3) setStatus("s-toi","status-ok","✅ Sesuai Standar");
          else if (TOI>3&&TOI<=5) setStatus("s-toi","status-warn","⚠️ Perlu Perhatian");
          else setStatus("s-toi","status-bad","❌ Di Luar Standar");
        } else setStatus("s-toi","status-na","N/A");
        setStatus("s-ndr","status-ok","✅ Data KRS diperlukan");

        const ruangList = fRuang ? [fRuang] : RUANG_LIST;
        const borVals=[], avlosVals=[], toiVals=[], rLabels=[], rows=[];
        ruangList.forEach(ruang => {
          const rData = data.filter(p => p.ruang === ruang);
          const rKeluar = rData.filter(p => p.status==="keluar");
          const rMasuk = rData.filter(p => p.status==="masuk").length;
          const rJK = rKeluar.length;
          const rHR = rKeluar.reduce((s,p) => s+hitungLOS(p),0);
          const tt = KAPASITAS[ruang] || 10;
          if (rMasuk===0 && rJK===0) return;
          const rBOR = tt>0&&hari>0 ? parseFloat(((rHR/(tt*hari))*100).toFixed(1)) : null;
          const rAVLOS = rJK>0 ? parseFloat((rHR/rJK).toFixed(1)) : null;
          const rBTO = tt>0&&rJK>0 ? parseFloat((rJK/tt).toFixed(2)) : null;
          const rTOI = rJK>0 ? parseFloat(((tt*hari-rHR)/rJK).toFixed(1)) : null;
          let badgeCls="badge-na", badgeTxt="N/A";
          if (rBOR!==null) {
            if (rBOR>=60&&rBOR<=85) { badgeCls="badge-ok"; badgeTxt="✅ Ideal"; }
            else if ((rBOR>=50&&rBOR<60)||(rBOR>85&&rBOR<=95)) { badgeCls="badge-warn"; badgeTxt="⚠️ Perhatian"; }
            else { badgeCls="badge-bad"; badgeTxt="❌ Di Luar Standar"; }
          }
          rows.push(`<tr>
            <td><strong>${ruang}</strong></td><td>${tt}</td>
            <td class="text-center">${rMasuk}</td><td class="text-center">${rJK}</td><td class="text-center">${rHR}</td>
            <td class="text-center"><strong>${rBOR!==null?rBOR+"%":"—"}</strong></td>
            <td class="text-center">${rAVLOS!==null?rAVLOS+" hr":"—"}</td>
            <td class="text-center">${rBTO!==null?rBTO:"—"}</td>
            <td class="text-center">${rTOI!==null?rTOI+" hr":"—"}</td>
            <td class="text-center"><span class="badge rounded-pill ${badgeCls}">${badgeTxt}</span></td>
          </tr>`);
          rLabels.push(ruang);
          borVals.push(rBOR!==null?rBOR:0);
          avlosVals.push(rAVLOS!==null?rAVLOS:0);
          toiVals.push(rTOI!==null?rTOI:0);
        });
        document.getElementById("spm-tabel").innerHTML = rows.length ? rows.join("") : '<tr><td colspan="10" class="empty-state">Tidak ada data untuk ruang yang dipilih</td></tr>';

        if (spmChartBOR) spmChartBOR.destroy();
        spmChartBOR = new Chart(document.getElementById("spm-chartBOR"), {
          type:"bar",
          data:{ labels:rLabels, datasets:[
            { label:"BOR (%)", data:borVals, backgroundColor:borVals.map(v=>v>=60&&v<=85?"rgba(34,197,94,.75)":v>0&&(v<60||(v>85&&v<=95))?"rgba(245,158,11,.75)":v===0?"rgba(203,213,225,.5)":"rgba(239,68,68,.75)"), borderRadius:8, borderWidth:0 },
            { type:"line", label:"Batas Bawah (60%)", data:rLabels.map(()=>60), borderColor:"#f59e0b", borderDash:[6,3], borderWidth:2, pointRadius:0, fill:false },
            { type:"line", label:"Batas Atas (85%)", data:rLabels.map(()=>85), borderColor:"#ef4444", borderDash:[6,3], borderWidth:2, pointRadius:0, fill:false }
          ]},
          options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:"top", labels:{ font:{ family:"Nunito", size:12, weight:"700" } } } }, scales:{ x:{ grid:{ display:false } }, y:{ beginAtZero:true, max:100, ticks:{ callback:v=>v+"%" } } } }
        });

        if (spmChartAVLOS) spmChartAVLOS.destroy();
        spmChartAVLOS = new Chart(document.getElementById("spm-chartAVLOS"), {
          type:"bar",
          data:{ labels:rLabels, datasets:[
            { label:"AVLOS (hari)", data:avlosVals, backgroundColor:avlosVals.map(v=>v>=6&&v<=9?"rgba(34,197,94,.7)":v>0?"rgba(245,158,11,.7)":"rgba(203,213,225,.5)"), borderRadius:8, borderWidth:0 },
            { type:"line", label:"Min (6 hr)", data:rLabels.map(()=>6), borderColor:"#f59e0b", borderDash:[5,3], borderWidth:2, pointRadius:0, fill:false },
            { type:"line", label:"Max (9 hr)", data:rLabels.map(()=>9), borderColor:"#ef4444", borderDash:[5,3], borderWidth:2, pointRadius:0, fill:false }
          ]},
          options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:"top" } }, scales:{ x:{ grid:{ display:false } }, y:{ beginAtZero:true } } }
        });

        if (spmChartTOI) spmChartTOI.destroy();
        spmChartTOI = new Chart(document.getElementById("spm-chartTOI"), {
          type:"bar",
          data:{ labels:rLabels, datasets:[
            { label:"TOI (hari)", data:toiVals, backgroundColor:toiVals.map(v=>v>=1&&v<=3?"rgba(139,92,246,.7)":v>3&&v<=5?"rgba(245,158,11,.7)":v===0?"rgba(203,213,225,.5)":"rgba(239,68,68,.7)"), borderRadius:8, borderWidth:0 },
            { type:"line", label:"Min (1 hr)", data:rLabels.map(()=>1), borderColor:"#22c55e", borderDash:[5,3], borderWidth:2, pointRadius:0, fill:false },
            { type:"line", label:"Max (3 hr)", data:rLabels.map(()=>3), borderColor:"#ef4444", borderDash:[5,3], borderWidth:2, pointRadius:0, fill:false }
          ]},
          options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:"top" } }, scales:{ x:{ grid:{ display:false } }, y:{ beginAtZero:true } } }
        });
        showToast("Indikator SPM berhasil dihitung!", "success");
      }

      function logout() {
        localStorage.removeItem("role");
        localStorage.removeItem("loggedUser");
        window.location.href = "/pilihakses";
      }

      applyFilterRekap();
    </script>
  </body>
</html>
<?php /**PATH C:\laragon\www\project-pbw\project-pbw\resources\views/pelaporan.blade.php ENDPATH**/ ?>