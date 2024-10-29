<?php

namespace App\Http\Controllers;

use App\Models\CutiIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('pegawai')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        $lok_kantor = DB::table('konfig_lokasi')->where('id', 1)->first();
        return view('presensi.create', compact('cek', 'lok_kantor'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_kantor = DB::table('konfig_lokasi')->where('id', 1)->first();
        $lok = explode(",", $lok_kantor->lokasi_kantor);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];


        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        if ($radius > $lok_kantor->radius) {
            echo "error|Jarak Anda " . $radius . " Meter Dari Kantor|radius";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    echo "success|Terima Kasih, Hati-Hati Di Jalan|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|out";
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terima Kasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|in";
                }
            }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $pegawai = DB::table('pegawai')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('pegawai'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $email = $request->email;
        $password = Hash::make($request->password);
        $pegawai = DB::table('pegawai')->where('nik', $nik)->first();
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $pegawai->foto;
        }
        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $foto,
                'password' => $password
            ];
        }

        $update = DB::table('pegawai')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/pegawai/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
    }

    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('pegawai')->user()->nik;
        $histori = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();
        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $dataizin = DB::table('cuti_izin')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function ajukanizin()
    {
        return view('presensi.ajukanizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $status = $request->status;
        $keterangan = $request->keterangan;
        $lampiran = $request->lampiran;
        if ($request->hasFile('lampiran')) {
            $folderPath = "public/uploads/lampiran";
            $lampiranName = $nik . '_' . $request->file('lampiran')->getClientOriginalName();
            $lampiran = $request->file('lampiran')->storeAs($folderPath, $lampiranName);
        }

        $data = [
            'nik' => $nik,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'status' => $status,
            'keterangan' => $keterangan,
            'lampiran' => $lampiran
        ];

        $simpan = DB::table('cuti_izin')->insert($data);
        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_dept')
            ->join('pegawai', 'presensi.nik', '=', 'pegawai.nik')
            ->join('departemen', 'pegawai.kode_dept', '=', 'departemen.kode_dept')
            ->where('tgl_presensi', $tanggal)
            ->get();


        return view('presensi.getpresensi', compact('presensi'));
    }

    public function laporan()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $pegawai = DB::table('pegawai')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namabulan', 'pegawai'));
    }

    public function cetaklaporan(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $pegawai = DB::table('pegawai')->where('nik', $nik)
            ->join('departemen', 'pegawai.kode_dept', '=', 'departemen.kode_dept')
            ->first();

        $presensi = DB::table('presensi')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->orderBy('tgl_presensi')
            ->get();

        if (isset($_POST['exportexcel'])) {
            $time = date("d-m-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Presensi $time.xls");
        }
        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'pegawai', 'presensi'));
    }

    public function rekap()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
            ->selectRaw('presensi.nik,nama_lengkap,
                MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
                MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
                MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
                MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
                MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
                MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
                MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
                MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
                MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
                MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
                MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
                MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
                MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
                MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
                MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
                MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
                MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
                MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
                MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
                MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
                MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
                MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
                MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
                MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
                MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
                MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
                MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
                MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
                MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
                MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
                MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_31')
            ->join('pegawai', 'presensi.nik', '=', 'pegawai.nik')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->groupByRaw('presensi.nik,nama_lengkap')
            ->get();

        if (isset($_POST['exportexcel'])) {
            $time = date("d-m-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi Pegawai $time.xls");
        }
        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namabulan', 'rekap'));
    }

    public function izincuti(Request $request)
    {
        $query = CutiIzin::query();
        $query->select('id', 'tgl_awal', 'tgl_akhir', 'cuti_izin.nik', 'nama_lengkap', 'jabatan', 'status', 'keterangan', 'lampiran', 'status_approvement');
        $query->join('pegawai', 'cuti_izin.nik', '=', 'pegawai.nik');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->where(function ($q) use ($request) {
                $q->whereBetween('tgl_awal', [$request->dari, $request->sampai])
                    ->orWhereBetween('tgl_akhir', [$request->dari, $request->sampai]);
            });
        }

        if (!empty($request->nik)) {
            $query->where('cuti_izin.nik', $request->nik);
        }

        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->status_approvement == '0' || $request->status_approvement == '1' || $request->status_approvement == '2') {
            $query->where('status_approvement', $request->status_approvement);
        }
        $query->orderBy('tgl_awal', 'desc');
        $query->orderBy('tgl_akhir', 'desc');
        $izincuti = $query->paginate(10);
        $izincuti->appends($request->all());
        return view('presensi.izincuti', compact('izincuti'));
    }

    public function approvalizincuti(Request $request)
    {
        $status_approvement = $request->status_approvement;
        $id_izincuti_form = $request->id_izincuti_form;
        $update = DB::table('cuti_izin')->where('id', $id_izincuti_form)->update([
            'status_approvement' => $status_approvement
        ]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Persetujuan Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Persetujuan Gagal Diupdate']);
        }
    }

    public function batalkanizincuti($id)
    {
        $update = DB::table('cuti_izin')->where('id', $id)->update([
            'status_approvement' => 0
        ]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Persetujuan Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Persetujuan Gagal Diupdate']);
        }
    }

    public function cekizincuti(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $nik = Auth::guard('pegawai')->user()->nik;
        $cek = DB::table('cuti_izin')->where('nik', $nik)->where('tgl_awal', $tgl_awal)->count();
        return $cek;
    }
}
