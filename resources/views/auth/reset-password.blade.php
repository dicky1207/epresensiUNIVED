<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    <style>
        .container {
        height: 115vh; /* Menetapkan tinggi kontainer ke 80% dari viewport */
        }
        .reset-password-container {
            max-width: 400px;
            width: 100%;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: auto;
            top: 50%;
            transform: translateY(-50%);
        }
    
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
    
        .btn-reset {
            margin-top: 3px;
        }

    </style>
    
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="reset-password-container bg-light">
            <div class="form-header">
                <h3>Lupa Password?</h3>
                <p class="text-muted text-left">Masukkan alamat email Anda dan kata sandi akan dikirim
                    melalui email.</p>
            </div>
            
            <form action="{{ route('password.request') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email"><b>Alamat E-mail</b></label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan E-mail Anda" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-reset">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="27"  height="27"  viewBox="0 0 27 27"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-key">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M21 12a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" /><path d="M12.5 11.5l-4 4l1.5 1.5" />
                    <path d="M12 15l-1.5 -1.5" />
                    </svg>
                    Kirim Password Baru
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/base.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>