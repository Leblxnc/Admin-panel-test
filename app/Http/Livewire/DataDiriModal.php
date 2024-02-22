<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DataDiriModal extends Component
{
    public $opendatadiri = false;
    public $opengambar = false;
    public $data;
    public $kldatadiri = ['nama_lengkap','tempat_lahir','tanggal_lahir','agama','pendidikan_terakhir','alamat','no_telp','pekerjaan','nomor_identitas'];
    public $kldatadirigambar = ['foto','scan_ijazah','kk','identitas'];
    public $datadir = [];
    public $currentIndex = 0;

    // menanmpilkan datadiri modal
    public function datadiri($id)
    {
    $this->datadir = User::with('datadiri','permohonan')->findOrFail($id);
    $this->opendatadiri = true;
    }

    public function gambardatadiri($id){
    $this->datadir = User::with('datadiri','permohonan')->findOrFail($id);
    $this->opengambar = true;
    }

    public function incrementIndex()
{

    $this->currentIndex = ($this->currentIndex + 1) % count($this->kldatadirigambar);
}

public function decrementIndex()
{
    $this->currentIndex = ($this->currentIndex - 1 + count($this->kldatadirigambar)) % count($this->kldatadirigambar);
}

    public function close(){
        $this->opendatadiri = false;
        $this->opengambar = false;
        $this->datadir = [];
    }

    public function render()
    {
        return view('livewire.data-diri-modal');
    }
}
