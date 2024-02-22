<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;


class DataVerifikasi extends Component
{
    use WithFileUploads;

    public $perm;
    public $data;
    public $permohonan;
    public $user;
    public $surat;
    public $uploadfile = false;
    
    public function mount($data, $perm)
    {
        $this->data = $data;
        $this->perm = $perm;
        $this->user = User::with('datadiri','permohonan')->findOrFail($data);
        $this->permohonan = $this->user->permohonan()->where('pm_id', $perm)->firstOrFail();
        $this->permohonan->surat_dimohon = $this->surat;
        // dd($this->user->datadiri->nama_lengkap);
    }

    public function verifikasi($status)
    {
        if($status !== 'Terverifikasi'){
            $this->permohonan->verifikasi = $status;
            $this->permohonan->save();
            session()->flash('message', 'Ditolak');
        }else{
            $this->uploadfile = true;}
    }

    public function upload()
{
    try {
        // File upload
        $filePath = 'public/surat_dimohon/';
        if (Storage::exists($filePath . '/surat_dimohon')) {
            Storage::delete($filePath . '/surat_dimohon');
        }
        $extension = $this->surat->getClientOriginalExtension();
        $fullname = $this->permohonan->kode_permohonan;
        $newname = $fullname . '.' . $this->permohonan->jenis_permohonan. '.' . $extension;
        $this->surat->storeAs($filePath, $newname);
        $this->permohonan->surat_dimohon = $newname;
        // End file upload

        // Set other properties and save the model
        $this->permohonan->verifikasi = 'Terverifikasi';
        $this->permohonan->verified_at = now();
        $this->permohonan->save();

        $this->uploadfile = false;
        session()->flash('message', 'Permohonan ' . $this->user->datadiri->nama_lengkap . ' Berhasil Terverifikasi.');
    } catch (\Exception $e) {
        // Handle the error
        session()->flash('error', 'An error occurred during the file upload process.');

        // Log the error for further investigation if needed
        //Log::error('File upload error: ' . $e->getMessage());
    }
}


    public function close()
    {
        $this->uploadfile = false;
    }

    public function render()
    {
        return view('livewire.data-verifikasi');
    }
}
