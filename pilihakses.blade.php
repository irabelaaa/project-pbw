<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilih Akses — Sensora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        font-family: "Nunito", sans-serif;
        min-height: 100vh;
        background-image: url({{ asset('blur-hospital.jpg') }});
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(10, 20, 60, 0.55);
        backdrop-filter: blur(2px);
      }

      .wrapper {
        position: relative;
        z-index: 1;
      }

      .brand-name {
        color: #dff2ff;
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: 8px;
        text-transform: uppercase;
        text-shadow: 0 2px 16px rgba(99, 102, 241, 0.7);
        font-style: italic;
      }

      .title-sub {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
      }

      .heading {
        color: #fff;
        font-size: 2.1rem;
        font-weight: 800;
      }

      .subtitle {
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.95rem;
      }

      /* Cards */
      .akses-card {
        background: rgba(255, 255, 255, 0.97);
        border-radius: 24px;
        padding: 40px 28px;
        width: 220px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
      }

      .akses-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
      }

      .akses-card.perawat:hover    { border-color: #4f46e5; }
      .akses-card.pelaporan:hover  { border-color: #0ea5e9; }
      .akses-card.pendaftaran:hover{ border-color: #8ddafe; }

      .card-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
      }

      .perawat    .card-icon { background: linear-gradient(135deg, #6366f1, #4f46e5); }
      .pelaporan  .card-icon { background: linear-gradient(135deg, #38bdf8, #0ea5e9); }
      .pendaftaran .card-icon{ background: linear-gradient(135deg, #37c3ff, #8ddafe); }

      .card-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #1e1e2e;
      }

      .card-desc {
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.5;
        text-align: center;
      }

      .card-btn {
        width: 100%;
        border: none;
        border-radius: 30px;
        padding: 10px 24px;
        font-family: "Nunito", sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        color: #fff;
        cursor: pointer;
        transition: opacity 0.2s;
        margin-top: auto;
      }

      .perawat    .card-btn { background: linear-gradient(135deg, #6366f1, #4f46e5); }
      .pelaporan  .card-btn { background: linear-gradient(135deg, #38bdf8, #0ea5e9); }
      .pendaftaran .card-btn{ background: linear-gradient(135deg, #37c3ff, #8ddafe); }

      .card-btn:hover { opacity: 0.85; }
    </style>
  </head>
  <body>
    <div class="wrapper text-center px-3 py-4">
      <p class="brand-name mb-1">⁓Sensora⁓</p>
      <p class="title-sub mb-3">Sistem Informasi Pelaporan Sensus Harian Rawat Inap</p>
      <h1 class="heading mb-2">Pilih Hak Akses</h1>
      <p class="subtitle mb-5">Silakan pilih akses sesuai peran Anda</p>

      <div class="d-flex flex-wrap justify-content-center gap-4">

        <div class="akses-card perawat" onclick="pilihRole('perawat')">
          <div class="card-icon">🩺</div>
          <div class="card-title">Perawat</div>
          <div class="card-desc">Akses khusus untuk tenaga keperawatan</div>
          <button class="card-btn">Masuk sebagai Perawat</button>
        </div>

        <div class="akses-card pelaporan" onclick="pilihRole('pelaporan')">
          <div class="card-icon">📋</div>
          <div class="card-title">Petugas Pelaporan</div>
          <div class="card-desc">Akses khusus untuk petugas pelaporan data</div>
          <button class="card-btn">Masuk sebagai Pelaporan</button>
        </div>

        <div class="akses-card pendaftaran" onclick="pilihRole('pendaftaran')">
          <div class="card-icon">👩🏻‍💻</div>
          <div class="card-title">Petugas Pendaftaran</div>
          <div class="card-desc">Akses khusus untuk petugas pendaftaran data</div>
          <button class="card-btn">Masuk sebagai Pendaftaran</button>
        </div>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  function pilihRole(role) {
    localStorage.setItem("role", role);
    window.location.href = "/login";
  }
</script>
  </body>
</html>
