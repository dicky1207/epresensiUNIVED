<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.8;
        }
        .email-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .email-container {
            max-width: 650px;
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        /* Header Styles */
        .email-header {
            background: linear-gradient(140deg, #004085, #007bff);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        .email-header p {
            font-size: 13px;
            margin-top: 5px;
            opacity: 0.8;
        }

        /* Body Styles */
        .email-body {
            padding: 30px 25px;
        }
        .email-body h3 {
            font-size: 20px;
            color: #0056b3;
            margin: 0 0 15px 0;
            font-weight: 600;
        }
        .email-body p {
            font-size: 14px;
            margin: 10px 0;
            color: #555;
        }
        .credentials {
            background: #f9fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border: 1px solid #e0e0e0;
        }
        .credentials p {
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        .credentials strong {
            color: #0056b3;
        }

        /* Button Styles */
        .action-button {
            display: inline-block;
            background: linear-gradient(140deg, #0056b3, #007bff);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 30px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
            transition: background 0.3s ease;
        }
        .action-button:hover {
            background: linear-gradient(140deg, #003c75, #0056b3);
        }

        /* Footer Styles */
        .email-footer {
            background: #f5f7fa;
            text-align: center;
            padding: 20px 25px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
        .email-footer p {
            margin: 5px 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .email-header h1 {
                font-size: 22px;
            }
            .email-body h3 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <h1>E-Presensi UNIVED</h1>
                <p>Universitas Dehasen Bengkulu</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <h3>Reset Password Akun</h3>
                <p>Yth. <strong>{{ $mailData['nama'] }}</strong>,</p>
                <p>Kami telah menerima permintaan untuk mereset kata sandi akun Anda. Berikut adalah informasi terbaru untuk masuk ke akun Anda:</p>

                <!-- Credentials -->
                <div class="credentials">
                    <p><strong>NIK:</strong> {{ $mailData['nik'] }}</p>
                    <p><strong>Password Baru:</strong> {{ $mailData['password_baru'] }}</p>
                </div>

                <p>Gunakan tombol di bawah ini untuk mengakses akun Anda. Demi keamanan, segera ganti kata sandi setelah berhasil masuk.</p>

                <!-- Button -->
                <a href="https://presensi.unived.web.id" class="action-button">Masuk ke Akun</a>

                <p style="margin-top: 20px; color: #777;">Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini dan akun Anda tetap aman.</p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>Email ini dikirim secara otomatis. Mohon untuk tidak membalas.</p>
                <p>Untuk bantuan lebih lanjut, silahkan menghubungi Admin Kepegawaian Universitas Dehasen Bengkulu.</p>
            </div>
        </div>
    </div>
</body>
</html>