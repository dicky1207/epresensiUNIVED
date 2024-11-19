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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eyeOffIcon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="display: none;" id="eyeIcon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" />
                            </svg>
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
      const eyeIcon = document.getElementById('eyeIcon');
      const eyeOffIcon = document.getElementById('eyeOffIcon');
  
      togglePassword.addEventListener('click', function (e) {
          e.preventDefault();
          // Toggle the type attribute
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          
          // Toggle the icons
          eyeIcon.style.display = type === 'password' ? 'none' : 'block';
          eyeOffIcon.style.display = type === 'password' ? 'block' : 'none';
      });
    </script>
  </body>
</html>