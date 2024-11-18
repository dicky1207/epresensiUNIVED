<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>E-Presensi Universitas Dehasen Bengkulu</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    <style>
        body {
            background: linear-gradient(180deg, #f5f3f3, #f5f3f3);
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background: rgb(255, 255, 255);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 368px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-button-group {
            text-align: center;
        }

        .form-button-group .btn {
            width: 100%;
            max-width: 368px;
            margin: 0 auto;
            display: block;
        }

        h1 {
            font-size: 24px; /* Ukuran font yang lebih kecil untuk judul */
            margin: 0; /* Menghilangkan margin default */
        }

        h4 {
            font-size: 16px; /* Ukuran font untuk subjudul */
            margin-top: 5px; /* Jarak atas untuk subjudul */
        }

        @media (max-width: 768px) {
            .login-form {
                padding: 15px;
            }
        }

        .input-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.4rem;
        }
    </style>
</head>

<body>
    <div id="appCapsule">
        <div class="login-form" id="login-form">
            <div class="section">
                <img src="{{ asset('assets/img/login/login.png') }}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>E-Presensi UNIVED</h1>
                <h4>Silahkan Log in</h4>
            </div>
            <div class="section mt-1 mb-5">
                @php
                    $messagewarning = Session::get('warning');
                @endphp
                @if (Session::get('warning'))
                <div class="alert alert-outline-warning">
                    {{ $messagewarning }}
                </div>
                @endif
                <form action="/proseslogin" method="POST">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" maxlength="7" autocomplete="off" name="nik" class="form-control" id="nik" placeholder="NIK">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            <span class="toggle-password" id="togglePassword">
                                <ion-icon name="eye-off"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div class="form-links">
                        <div>
                            <a href="/reset-password" class="text-muted">Lupa Password?</a>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/base.js') }}"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Toggle the eye icon
            this.querySelector('ion-icon').name = type === 'password' ? 'eye-off' : 'eye';
            e.preventDefault();
        });
    </script>
</body>

</html>