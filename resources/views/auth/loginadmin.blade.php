<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>E-Presensi UNIVED (BACK OFFICE)</title>
    <!-- CSS files -->
    <link rel="icon" type="image/png" href="{{ asset('tabler/static/favicon.png') }}" sizes="32x32">
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css?1692870487') }}" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
        background: linear-gradient(180deg, #f5f3f3, #f5f3f3); /* Latar belakang gradien */
        height: 100vh; /* Tinggi penuh */
        display: flex; /* Flexbox untuk pusat */
        align-items: center; /* Pusat secara vertikal */
        justify-content: center; /* Pusat secara horizontal */
      }
      .glassmorphism {
        background: rgba(255, 255, 255, 0.1); /* Warna latar belakang transparan */
        backdrop-filter: blur(15px); /* Efek blur di belakang */
        border-radius: 15px; /* Radius sudut */
        border: 1px solid rgba(255, 255, 255, 0.2); /* Border putih transparan */
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Bayangan */
        max-width: 368px; /* Ubah lebar maksimum untuk card */
        width: 100%; /* Pastikan card menggunakan lebar penuh dari kontainer */
      }
      .card-body {
        padding: 2rem; /* Padding untuk card */
      }
    </style>
  </head>
  <body>
    <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark">
          </a>
        </div>
        <div class="card card-md glassmorphism"> <!-- Tambahkan kelas glassmorphism -->
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Login Administrator</h2>
            @if(Session::get('warning'))
              <div class="alert alert-warning">
                <p>{{ Session::get('warning') }}</p>
              </div>
            @endif
            <form action="/prosesloginadmin" method="post" autocomplete="off" novalidate>
              @csrf
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="email" name="username" class="form-control" placeholder="Masukkan Username" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">Password</label>
                <div class="input-group input-group-flat">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" autocomplete="off">
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" data-bs-toggle="tooltip" id="togglePassword">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill=" none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                  </span>
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Log in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1692870487') }}" defer></script>
    <script>
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function (e) {
          // Toggle the type attribute
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          // Toggle the eye slash icon
          this.querySelector('svg').classList.toggle('icon-eye-off');
          e.preventDefault();
      });
  </script>
  </body>
</html>