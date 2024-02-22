<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataUsers extends Component
{
    use WithPagination;
    public $search;
    public $pendingonly = false;
    //sort
    public $sortkolom = 'users.created_at';
    public $sort = 'asc';

    protected $paginationTheme = 'bootstrap';

    //file atau foto
    public $showfoto = false;

    //penentu muncul atau tidaknya moda
    
    public $openpermohonan = false;
    


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

    public function edit($usersId)
    {
        return redirect()->route('useredit', ['id' => $usersId]);
    }


    public function render()
    {
        $users = User::where('is_admin', 0)->with('datadiri')
        ->when($this->search, function ($query, $search){
            $query->where('email', 'LIKE', '%'.$search.'%');
            $query->orWhereHas('datadiri', function ($query) use ($search){
                $query->where('nama_lengkap', 'LIKE', '%'.$search.'%');
                $query->orWhere('no_telp', 'LIKE', '%'.$search.'%');
            });
        })
        ->join('datadiri', 'users.id', '=', 'datadiri.user_id')
        ->orderBy($this->sortkolom, $this->sort)
        ->paginate(10);

        return view('livewire.data-users',['users'=>$users]);
    }
}
