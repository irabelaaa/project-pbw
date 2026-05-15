<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Sensora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        font-family: "Nunito", sans-serif;
        min-height: 100vh;
        background-image: url(<?php echo e(asset('blur-hospital.jpg')); ?>);
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

      .login-box {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.97);
        border-radius: 24px;
        padding: 48px 48px 40px;
        width: 480px;
        max-width: 95vw;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
      }

      /* Role badge */
      .role-badge {
        display: block;
        width: fit-content;
        margin: 0 auto 20px;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
      }

      .role-badge.perawat    { background: #ede9fe; color: #4f46e5; }
      .role-badge.pelaporan  { background: #e0f2fe; color: #0ea5e9; }
      .role-badge.pendaftaran{ background: #e0f2fe; color: #38bdf8; }

      /* Header */
      .login-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #1e1e2e;
      }

      .login-header p {
        font-size: 0.88rem;
        color: #6b7280;
      }

      /* Inputs */
      .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
      }

      .form-control {
        height: 52px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-family: "Nunito", sans-serif;
        font-size: 0.95rem;
        color: #1e1e2e;
        background: #f9fafb;
        transition: border-color 0.2s, background 0.2s;
      }

      .form-control:focus {
        background: #fff;
        box-shadow: none;
      }

      .form-control.focus-perawat:focus     { border-color: #4f46e5; }
      .form-control.focus-pelaporan:focus   { border-color: #0ea5e9; }
      .form-control.focus-pendaftaran:focus { border-color: #38bdf8; }

      /* Remember & forgot */
      .remember-label {
        font-size: 0.82rem;
        color: #6b7280;
        cursor: pointer;
      }

      .form-check-input {
        accent-color: #4f46e5;
      }

      .forgot-link {
        font-size: 0.82rem;
        font-weight: 600;
        color: #4f46e5;
        text-decoration: none;
      }

      .forgot-link:hover { text-decoration: underline; }

      /* Submit */
      .submit-btn {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 12px;
        font-family: "Nunito", sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.2s;
      }

      .submit-btn.perawat    { background: linear-gradient(135deg, #6366f1, #4f46e5); }
      .submit-btn.pelaporan  { background: linear-gradient(135deg, #38bdf8, #0ea5e9); }
      .submit-btn.pendaftaran{ background: linear-gradient(135deg, #37c3ff, #8ddafe); }

      .submit-btn:hover { opacity: 0.88; transform: translateY(-1px); }

      /* Back link */
      .back-link {
        font-size: 0.82rem;
        color: #6b7280;
      }

      .back-link a {
        font-weight: 700;
        color: #4f46e5;
        text-decoration: none;
      }

      .back-link a:hover { text-decoration: underline; }

      /* Toast */
      .toast-custom {
        position: fixed;
        top: 24px;
        right: 24px;
        padding: 14px 22px;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #fff;
        z-index: 1055;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        pointer-events: none;
      }

      .toast-custom.show    { opacity: 1; transform: translateY(0); }
      .toast-custom.success { background: #22c55e; }
      .toast-custom.error   { background: #ef4444; }
    </style>
  </head>
  <body>
    <div class="login-box" id="loginBox">
      <div id="roleBadge" class="role-badge"></div>

      <div class="login-header text-center mb-4">
        <h1>Selamat Datang 👋</h1>
        <p>Masukkan email dan password</p>
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <input
          type="text"
          id="username"
          class="form-control"
          placeholder="nama@student.polije.ac.id"
          autocomplete="new-password"
          readonly
          onfocus="this.removeAttribute('readonly')"
        />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          class="form-control"
          placeholder="Masukkan password"
          autocomplete="new-password"
          readonly
          onfocus="this.removeAttribute('readonly')"
        />
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4 mt-1">
        <div class="form-check d-flex align-items-center gap-2 m-0">
          <input class="form-check-input mt-0" type="checkbox" id="check" />
          <label class="remember-label form-check-label" for="check">Ingat saya</label>
        </div>
        <a href="#" class="forgot-link">Lupa password?</a>
      </div>

      <button class="submit-btn" id="loginBtn" onclick="login()">Masuk</button>

      <div class="back-link text-center mt-3">
    <a href="/pilihakses">Kembali pilih akses</a>
</div>

    <div class="toast-custom" id="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let role = localStorage.getItem("role");
  if (!role) {
    window.location.href = "/pilihakses";
  }

  const badge     = document.getElementById("roleBadge");
  const btn       = document.getElementById("loginBtn");
  const passInput = document.getElementById("password");
  const userInput = document.getElementById("username");

  if (role === "perawat") {
    badge.textContent = "🩺 Perawat";
    badge.className = "role-badge perawat";
    btn.className = "submit-btn perawat";
    passInput.classList.add("focus-perawat");
    userInput.classList.add("focus-perawat");
  } else if (role === "pelaporan") {
    badge.textContent = "📋 Petugas Pelaporan";
    badge.className = "role-badge pelaporan";
    btn.className = "submit-btn pelaporan";
    passInput.classList.add("focus-pelaporan");
    userInput.classList.add("focus-pelaporan");
  } else {
    badge.textContent = "👩🏻‍💻 Petugas Pendaftaran";
    badge.className = "role-badge pendaftaran";
    btn.className = "submit-btn pendaftaran";
    passInput.classList.add("focus-pendaftaran");
    userInput.classList.add("focus-pendaftaran");
  }

  const akun = {
    perawat: [
      { username: "g41241115@student.polije.ac.id", password: "g41241115" },
      { username: "g41241697@student.polije.ac.id", password: "g41241697" },
    ],
    pelaporan: [
      { username: "g41241571@student.polije.ac.id", password: "g41241571" },
      { username: "g41241447@student.polije.ac.id", password: "g41241447" },
      { username: "g41241697@student.polije.ac.id", password: "g41241697" },
    ],
    pendaftaran: [
      { username: "g41241115@student.polije.ac.id", password: "g41241115" },
      { username: "g41241697@student.polije.ac.id", password: "g41241697" },
    ],
  };

  function showToast(msg, type) {
    const toast = document.getElementById("toast");
    toast.textContent = msg;
    toast.className = `toast-custom ${type} show`;
    setTimeout(() => (toast.className = "toast-custom"), 3000);
  }

  function login() {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value;

    if (!username || !password) {
      showToast("Email dan password wajib diisi!", "error");
      return;
    }

    let daftarAkun = akun[role];
    let valid = daftarAkun.find(
      (u) => u.username === username && u.password === password
    );

    if (valid) {
      localStorage.setItem("loggedUser", username);
      showToast("Login berhasil! Mengalihkan...", "success");
      const tujuan =
        role === "perawat"
          ? "/home"
          : role === "pelaporan"
          ? "/pelaporan"
          : "/pendaftaran";
      setTimeout(() => (window.location.href = tujuan), 1500);
    } else {
      showToast("Email atau password salah!", "error");
    }
  }

  document.addEventListener("keydown", (e) => {
    if (e.key === "Enter") login();
  });
</script>
  </body>
</html>
<?php /**PATH C:\laragon\www\project-pbw\resources\views/login.blade.php ENDPATH**/ ?>