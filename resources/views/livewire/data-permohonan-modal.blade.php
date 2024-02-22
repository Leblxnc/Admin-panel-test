<div><center>
    <button class="btn btn-info m-2" wire:click="permohonan({{ $data}}, {{ $perm }})">Permohonan</button>
    </center>
    @if ($openpermohonan)
  <div class="modal fade show" tabindex="-1" role="dialog" style="display: block; overflow-y: auto;">
      <div class="modal-dialog" role="document" >
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Permohonan</h5>
                  <button type="button" wire:click='close' class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                @foreach ($klpermohonan as $kolm)
                    <p>{{$kolm}}  :   {{$this->permohon->$kolm}}</p>                    
                @endforeach
              </div>
              <div class="modal-footer">
                  <button wire:click='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal-backdrop fade show"></div>
@endif

</div>
