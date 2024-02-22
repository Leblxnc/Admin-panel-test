<div>
    {{-- modal data --}}
    <button class="btn btn-info m-2" wire:click="datadiri({{ $data}})">Datadiri</button>
    @if ($opendatadiri)
  <div class="modal fade show" tabindex="-1" role="dialog" style="display: block; overflow-y: auto;">
      <div class="modal-dialog" role="document" >
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Datadiri</h5>
                  <button type="button" wire:click='close' class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                @foreach ($kldatadiri as $kol)
                    <p>{{$kol}}  :   {{$this->datadir->datadiri->$kol}}</p>                    
                @endforeach
              </div>
              <div class="modal-footer">
                  <button wire:click='close' type="button" class="btn btn-secondary" data-dismiss="modal">Tutup/button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal-backdrop fade show"></div>
@endif

{{-- modal gambar --}}
{{-- <button class="btn btn-primary m-2" wire:click="gambardatadiri({{ $data}})">Gambar</button>
@if($opengambar)
<div class="modal" tabindex="-1" role="dialog" style="display: block; overflow-y: auto;>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Slider Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($kldatadirigambar as $index => $image)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if($index == $currentIndex) active @endif"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" >
                        @foreach($kldatadirigambar as $index => $image)
                            <div class="carousel-item @if($index == $currentIndex) active @endif">
                                <center>
                                    <label for="{{ $image }}">{{ ucfirst(str_replace('_', ' ', $image)) }}</label>
                                <img src="{{ Storage::url('public/' . $image . '/' . $this->datadir->datadiri->{$image}) }}" class="d-block" style="max-width: 100vh; max-height: 100vh; " alt="...">
                                </center>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#" role="button" data-slide="prev" wire:click.prevent="decrementIndex">
                        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#" role="button" data-slide="next" wire:click.prevent="incrementIndex">
                        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <button wire:click='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif --}}

</div>
