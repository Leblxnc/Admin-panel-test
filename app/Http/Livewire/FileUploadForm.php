<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploadForm extends Component
{
    use WithFileUploads;

    

    public function render()
    {
        return view('livewire.file-upload-form');
    }
}
