<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateUser extends Component
{
    public $userId;
    public $user;
    public $terpilih = '';
    public $inputlain = false;
    // prepopulated
    public $kl;
    use WithFileUploads;

    public function pilih($pilihan){
        $this->terpilih = $pilihan;
        if ($this->$pilihan === 'Lainnya'){
            $this->inputlain = true;
        }
        elseif($this->$pilihan != 'Lainnya'){
            $this->inputlain = false;
        }
    }
    public function showin(){
        $this->inputlain = true;
    }

    public function mount($user)
    {
        if ($user) {
            foreach ($this->kl as $k) {
                if($k === 'email'){
                    $this->{$k} = $user->{$k};
                }else{
                $this->{$k} = $user->datadiri->{$k};
            }}
        }
    }

    public function render()
    {
        return view('livewire.update-user');
    }
    
    public function update()
    {
        try{
        $this->validate([
            'user.email' => 'required|email|unique:users,email,' . $this->user->id,
            // add validation rules for other fields here
        ]);
        foreach ($this->kl as $k) {
            if($k === 'email'){
            $this->user->{$k} = $this->{$k};
            $this->user->save();
            }
            if($k != 'email'){
                if (in_array($k, ['foto','scan_ijazah','kk','identitas']) && $this->{$k} instanceof \Illuminate\Http\UploadedFile) {
                    $filePath = 'public/' . $k . '/';
                    if (Storage::exists($filePath . '/' . $this->user->datadiri->{$k})) {
                        Storage::delete($filePath . '/' . $this->user->datadiri->{$k});
                    }
                    $extension = $this->{$k}->getClientOriginalExtension();
                    $fullname = str_replace(' ', '', $this->user->datadiri->nama_lengkap);
                    $newFilename = uniqid('', true) . '_'. $k . '.'  . $fullname . '.' . $extension;
                    // store the new file in the public disk
                    $this->{$k}->storeAs($filePath, $newFilename);
                    $this->user->datadiri->{$k} = $newFilename;}
                else{
                    $this->user->datadiri->{$k} = $this->{$k};
                }
                $this->user->datadiri->save();
            }
        }
    
        session()->flash('message', 'User updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', 'An error occurred during the file upload process.');
    }
    }
    
}
