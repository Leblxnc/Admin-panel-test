<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DataPermohonanModal extends Component
{
    public $openpermohonan = false;
    public $opengmbr = false;
    public $data;//id
    public $perm;//id
    public $klpermohonan = ['kode_permohonan','jenis_permohonan','alasan_permohonan','nomor_skck','keterangan'];
    public $klpermohonangambar = ['skck','pengiriman_berkas','bukti_transfer_PNBP'];
    public $klpermohonanfile = ['skck','surat_pernyataan','suket_pengantar_partai','suket_pengantar_desa'];
    public $use;
    public $permohon = [];
    public $currentIndex = 0;

    // menanmpilkan datadiri modal
    public function permohonan($id, $id_perm)
    {
    $this->use = User::with('datadiri','permohonan')->findOrFail($id);
    $this->permohon = $this->use->permohonan()->where('pm_id', $id_perm)->firstOrFail();
    $this->openpermohonan = true;
    }

    public function gambarpermohonan($id, $idperm){
    $this->permohon = User::with('datadiri','permohonan')->findOrFail($id);
    $this->opengmbr = true;
    }

    public function incrementIndex()
{

    $this->currentIndex = ($this->currentIndex + 1) % count($this->klpermohonangambar);
}

public function decrementIndex()
{
    $this->currentIndex = ($this->currentIndex - 1 + count($this->klpermohonangambar)) % count($this->kldatadirigambar);
}

    public function close(){
        $this->openpermohonan = false;
        $this->opengmbr = false;
        $this->permohon = [];
    }

    public function render()
    {
        return view('livewire.data-permohonan-modal');
    }
}
