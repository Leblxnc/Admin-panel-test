<div wire:poll.10s>
    {{-- @php
    dd($this->permohonan->verifikasi);
    @endphp --}}

    @if ($this->permohonan->verifikasi === 'Pending')
    <center>
    <button class="btn btn-success m-2" wire:click="verifikasi('Terverifikasi')">Verifikasi</button>
    <button class="btn btn-danger m-2" wire:click="verifikasi('Ditolak')">Ditolak</button>
    </center>
    @elseif($this->permohonan->verifikasi === 'Terverifikasi')
    <center>
    <button class="btn btn-success m-2">Terverifikasi</button>
    </center>
    @else
    <center>
    <button class="btn btn-danger m-2">Ditolak</button>
    </center>
    @endif

    @if ($this->uploadfile)
    <div class="modal fade show" tabindex="-1" role="dialog" style="display: block; overflow-y: auto;">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload</h5>
                    <button type="button" wire:click='close' class="close"aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="upload">
                        <input type="file" wire:model.lazy="surat">
                        <div class="modal-footer">
                            <button wire:click='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    @endif
    @if (session()->has('message'))
    <script>
        $(document).ready(function() {
            var toastClass = '{{ session('message') === 'Ditolak' ? 'bg-danger' : 'bg-success' }}';

            $(document).Toasts('create', {
                class: toastClass,
                title: 'Status',
                body: '{{ session('message') }}'
            });

            setTimeout(function() {
                $('.toast').toast('hide');
            }, 10000); // 10 seconds
        });
    </script>
@endif
</div>
