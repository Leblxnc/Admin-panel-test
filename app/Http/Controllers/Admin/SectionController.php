<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\permohonan;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // hitung data yang ada
    public function dashboard(){
        $jumlahuser = User::where('is_admin', 0)->count();
        $jumlahpermohonan = permohonan::count();
        $jumlahpermohonanbulanini = permohonan::whereMonth('permohonan.created_at', now()->month)->whereYear('permohonan.created_at', now()->year)->count();

        return view('admin.layout.dashboard', compact('jumlahuser','jumlahpermohonan'));
    }

    // show user data
    public function show()
    {   
        $users = User::where('is_admin', 0)->with('datadiri')->get();
        return view('admin.layout.userview', compact('users'));
    }

    // show edit user terpilih
    public function edit($id)
    {
        $user = User::with('datadiri')->findOrFail($id);
        $kolom = ['foto', 'email', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'pendidikan_terakhir', 'scan_ijazah', 'alamat', 'no_telp', 'pekerjaan', 'kk', 'nomor_identitas', 'identitas'];
        return view('admin.layout.useredit', [
            'user' => $user,
            'userId' => $id,
            'kl' => $kolom
        ]);
    }

    public function showpermohonan(){
        $users = User::where('is_admin', 0)->with('datadiri', 'permohonan')->get();
    return view('admin.layout.permohonanview', compact('users'));
    }
}
