<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $cari = Pegawai::query();
        $cari->select('pegawai.*', 'nama_dept');
        $cari->join('departemen', 'pegawai.kode_dept', '=', 'departemen.kode_dept');
        $cari->orderBy('nama_lengkap');
        if (!empty($request->nama_pegawai)) {
            $cari->where('nama_lengkap', 'like', '%' . $request->nama_pegawai . '%');
        }

        if (!empty($request->kode_dept)) {
            $cari->where('pegawai.kode_dept', $request->kode_dept);
        }

        $pegawai = $cari->paginate(10);

        $departemen = DB::table('departemen')->get();
        return view('pegawai.index', compact('pegawai', 'departemen'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $kode_dept = $request->kode_dept;
        $no_hp = $request->no_hp;
        $email = $request->email;
        $password = Hash::make('1234');
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'kode_dept' => $kode_dept,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('pegawai')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/pegawai/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Pegawai Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            $message = 'Data Pegawai Gagal Disimpan';
            if ($e->getCode() == 23000) {
                $message = "Data Dengan NIK " . $nik . " Sudah Ada";
            }
            return Redirect::back()->with(['warning' => $message]);
        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $pegawai = DB::table('pegawai')->where('nik', $nik)->first();
        return view('pegawai.edit', compact('departemen', 'pegawai'));
    }

    public function update($nik, Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $kode_dept = $request->kode_dept;
        $no_hp = $request->no_hp;
        $email = $request->email;
        $password = Hash::make('1234');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'kode_dept' => $kode_dept,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('pegawai')->where('nik', $nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/pegawai/";
                    $folderPathOld = "public/uploads/pegawai/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Pegawai Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Pegawai Gagal Diupdate']);
        }
    }

    public function delete($nik)
    {
        $delete = DB::table('pegawai')->where('nik', $nik)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Pegawai Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Pegawai Gagal Dihapus']);
        }
    }
}
