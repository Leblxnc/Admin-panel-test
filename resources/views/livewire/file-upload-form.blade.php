<div>
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form wire:submit.prevent="upload" enctype="multipart/form-data">
            <input type="file" wire:model="file">
    
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    
</div>
