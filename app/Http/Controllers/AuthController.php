<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
   public function proseslogin(Request $request)
   {
      if (Auth::guard('pegawai')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
         return redirect('/dashboard');
      } else {
         return redirect('/')->with(['warning' => 'NIK atau Password Salah']);
      }
   }

   public function proseslogout()
   {
      if (Auth::guard('pegawai')->check()) {
         Auth::guard('pegawai')->logout();
         return redirect('/');
      }
   }

   public function proseslogoutadmin()
   {
      if (Auth::guard('user')->check()) {
         Auth::guard('user')->logout();
         return redirect('/panel');
      }
   }

   public function prosesloginadmin(Request $request)
   {
      if (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
         return redirect('/panel/dashboardadmin');
      } else {
         return redirect('/panel')->with(['warning' => 'Username atau Password Salah']);
      }
   }

   // Menampilkan form untuk reset password
   public function showResetForm()
   {
       return view('auth.reset-password');
   }

   // Mengirim password baru ke email pegawai
   public function sendNewPassword(Request $request)
   {
       $request->validate(['email' => 'required|email']);

       $pegawai = DB::table('pegawai')->where('email', $request->email)->first();

       if (!$pegawai) {
           return back()->withErrors(['error' => 'Email tidak ditemukan.']);
       }

       // Generate password baru
       $newPassword = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

       // Update password baru di database
       DB::table('pegawai')->where('email', $request->email)->update([
           'password' => Hash::make($newPassword)
       ]);

       // Data untuk email
       $mailData = [
           'nama' => $pegawai->nama_lengkap,
           'nik' => $pegawai->nik,
           'password_baru' => $newPassword
       ];

       // Kirim email dengan password baru
       Mail::to($request->email)->send(new KirimEmail($mailData));

       return redirect()->route('login')->with('success', 'Password baru telah dikirim ke email Anda.');
   }
}
