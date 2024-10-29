<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik = Auth::guard('pegawai')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();

        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $rekapizin = DB::table('cuti_izin')
            ->selectRaw('SUM(IF(status = "c",1,0)) as jmlcuti, SUM(IF(status = "i",1,0)) as jmlizin')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_awal) = ?', [$bulanini])
            ->whereRaw('YEAR(tgl_awal) = ?', [$tahunini])
            ->where('status_approvement', 1)
            ->first();
        return view('dashboard.dashboard', compact('presensihariini', 'namabulan', 'bulanini', 'tahunini', 'rekappresensi', 'rekapizin'));
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
            ->where('tgl_presensi', $hariini)
            ->first();

        $rekapizin = DB::table('cuti_izin')
            ->selectRaw('SUM(IF(status = "c",1,0)) as jmlcuti, SUM(IF(status = "i",1,0)) as jmlizin')
            ->whereDate('tgl_awal', '<=', $hariini)
            ->whereDate('tgl_akhir', '>=', $hariini)
            ->where('status_approvement', 1)
            ->first();
        return view('dashboard.dashboardadmin', compact('rekappresensi', 'rekapizin'));
    }
}
