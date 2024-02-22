<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Livewire\Component;
use ZipArchive;

class DataDownload extends Component
{
    public $data;
    public $perm;
    public $downloader = [];
    public $downloadperm;
    public $kldatadirigambar = ['foto','scan_ijazah','kk','identitas'];
    public $klpermohonangambar = ['skck','pengiriman_berkas','bukti_transfer_PNBP'];
    public $klpermohonanfile = ['surat_pernyataan','suket_pengantar_partai','suket_pengantar_desa'];
    public $a =0;
    public $gmbr= [];

    public function download($id, $id_permohonan){

        $this->downloader = User::with('datadiri','permohonan')->findOrFail($id);
        $this->downloadperm = $this->downloader->permohonan()->where('pm_id', $id_permohonan)->firstOrFail();
        foreach($this->kldatadirigambar as $filedd){
        $datadirifile = $this->downloader->datadiri->where('user_id', $id)->pluck($filedd)->toArray();
        $this->gmbr = array_merge($this->gmbr, $datadirifile);
        }
        // fetch file name permohonan
        $klpermohonan = array_merge($this->klpermohonanfile, $this->klpermohonangambar);
        foreach($klpermohonan as $filepm){
        $permohonanfile =$this->downloadperm->where('pm_id', $id_permohonan)->pluck($filepm)->toArray();
        $this->gmbr = array_merge($this->gmbr, $permohonanfile);
        }
        // download
        
        $zip = new ZipArchive();
        $zip_filename = 'file-'. $this->downloadperm->kode_permohonan . '-'. $this->downloader->datadiri->nama_lengkap. '.zip' ;
        
        if ($zip->open($zip_filename, ZipArchive::CREATE) !== true) {
            throw new Exception('Unable to create zip archive');
        }
        $kolom = array_merge($this->kldatadirigambar, $klpermohonan);
        $i = 0;
        $ab = [];
        $cd = [];
        foreach ($this->gmbr as $file) {
            // get the file name and path
            foreach ($kolom as $k){
            if(array_search($file, $this->gmbr) === $i && array_search($k, $kolom) === $i){
            $file_path = public_path('storage\\'. $k .'\\' . $file);
            if (file_exists($file_path) && $file !== null) {
                $ab[] = $file_path;
                $zip->addFile($file_path, $file);
            } else {
                $cd[] = $file_path;
                continue;
            }
            $i++;
            }
            }
                
        }
        $zip->close();

        return response()->download($zip_filename)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.data-download');
    }
}
