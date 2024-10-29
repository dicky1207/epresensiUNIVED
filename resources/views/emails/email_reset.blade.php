<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #FFB400;">E-Presensi UNIVED Bengkulu</h2>
        
        <p>Halo, <strong>{{ $mailData['nama'] }}</strong>!</p>
        
        <p>Kami telah menerima permintaan untuk mereset password akun Anda. Silakan menggunakan detail di bawah ini untuk masuk ke akun Anda:</p>
        
        <p><strong>NIK:</strong> {{ $mailData['nik'] }}<br>
        <strong>Password Baru:</strong> {{ $mailData['password_baru'] }}</p>
        
        <p><em>Harap segera mengganti password setelah berhasil login, untuk menjaga keamanan akun Anda.</em></p>
        
        <p style="color: #555;">Jika Anda tidak pernah meminta reset password ini, silakan abaikan email ini.</p>
        
        <p>Terima kasih,</p>
        <p><strong>Admin Kepegawaian</strong></p>
        
        <hr style="border: none; border-top: 1px solid #ddd;">
        <p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis, mohon untuk tidak membalas. Jika Anda membutuhkan bantuan, hubungi Admin Kepegawaian.</p>
    </div>
</body>
</html>