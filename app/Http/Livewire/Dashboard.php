<?php

namespace App\Http\Livewire;

use App\Models\permohonan;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    //tampilan
    public $tablepermohonan = false;
    public $tableuser = false;

    public $jumlahuser;
    public $jumlahpermohonan;
    public $jumlahpermohonanpending;
    public $jumlahpermohonanverifikasi;
    public $jumlahpermohonanditolak;

    public function showpermohonan()
    {
        return redirect()->route('showpermohonan');
    }

    public function showuser()
    {
        return redirect()->route('userview');
    }

    public function mount()
    {
        $this->jumlahuser = User::where('is_admin', 0)->count();
        $this->jumlahpermohonan = permohonan::count();
        $this->jumlahpermohonanpending = permohonan::where('verifikasi', 'Pending')->count();
        $this->jumlahpermohonanverifikasi = permohonan::where('verifikasi', 'terverifikasi')->count();
        $this->jumlahpermohonanditolak = permohonan::where('verifikasi', 'ditolak')->count();
    }

    public function render()
    {
        return view('livewire.dashboard-Component');
    }
}
