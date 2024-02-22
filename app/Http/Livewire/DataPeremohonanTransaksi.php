<?php

namespace App\Http\Livewire;

use App\Models\permohonan;
use Livewire\Component;
use Livewire\WithPagination;

class DataPeremohonanTransaksi extends Component
{
    use WithPagination;
    public $user;
    public $kol;
    public $search;

    //sort
    public $sortkolom = 'permohonan.created_at';
    public $sort = 'asc';

    protected $paginationTheme = 'bootstrap';

    //file atau foto
    public $showfoto = false;

    //penentu muncul atau tidaknya moda
    
    public $openpermohonan = false;
    
    
    // menampilkan gambar datadiri
    public function gambardatadiri($kol){
        $this->kol = $kol;
        if($kol === 'foto'){
            $this->showfoto = true;
        }
    }

    //sorting
    public function sortir($kolom)
    {
        if($kolom === $this->sortkolom){
            $this->sort = $this->sort === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortkolom =$kolom;
            $this->sort = 'asc';
        }
    }

    public function render()
{
    $permohonan = permohonan::with('user.datadiri')
        ->when($this->search, function ($query, $search) {
            $query->where('kode_permohonan', 'LIKE', '%'.$search.'%')
                ->orWhereHas('user.datadiri', function ($query) use ($search) {
                    $query->where('nama_lengkap', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                });
        })
        ->join('users', 'permohonan.user_id', '=', 'users.id')
        ->join('datadiri', 'users.id', '=', 'datadiri.user_id')
        ->whereMonth('created_at', now()->month) // Filter records for the current month
        ->whereYear('created_at', now()->year) // Filter records for the current year
        ->whereNull('Tagihan')
        ->orderBy($this->sortkolom, $this->sort)
        ->paginate(10);
    
    return view('livewire.data-permohonan-transaksi', [
        'permohonan' => $permohonan
    ]);
}

}