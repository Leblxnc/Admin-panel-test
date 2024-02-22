 <div class="m-4">
    <form wire:submit.prevent="update">
        <div class="container m-2">
            @foreach ($kl as $k)
            @if (in_array($k, ['foto','scan_ijazah','kk','identitas']))
            <div class="form-group">
                <label for="{{ $k }}">{{ ucfirst(str_replace('_', ' ', $k)) }}</label>
                @if ($this->user->datadiri->{$k})
                <div style="display: flex; justify-content: center; align-items: center;">
                        <img src="{{ Storage::url('public/' . $k . '/' . $this->user->datadiri->{$k}) }}" width="150" height="150">
                    </div>
                @endif
                <input type="file" class="form-control mt-4" id="{{ $k }}" wire:model.lazy="{{ $k }}">
            </div>
            @elseif ($k === 'email')
                <div class="form-group">
                    <label for="{{ $k }}">{{ ucfirst(str_replace('_', ' ', $k)) }}</label>
                    <input type="email" class="form-control" id="{{ $k }}" wire:model.defer="{{ $k }}">
                </div>
            @elseif ($k === 'tanggal_lahir')
                <div class="form-group">
                    <label for="{{ $k }}">{{ ucfirst(str_replace('_', ' ', $k)) }}</label>
                    <input type="date" class="form-control" id="{{ $k }}" wire:model.defer="{{ $k }}">
                </div>
            @elseif (in_array($k, ['jenis_kelamin', 'agama', 'pendidikan_terakhir', 'jenis_identitas']))
                <div class="form-group">
                    <label for="{{ $k }}">{{ ucfirst(str_replace('_', ' ', $k)) }}</label>
                    <p>{{$k}} : {{ $this->user->datadiri->{$k} }}</p>
                    <select class="form-control" id="{{ $k }}" wire:model.defer="{{ $k }}" wire:change="pilih('{{ $k }}')">
                    @switch($k)
                        @case('jenis_kelamin')
                            @foreach(['Pria', 'Wanita'] as $jk)
                            <option value="{{ $jk }}">{{ ucfirst($jk) }}</option>
                            @endforeach
                            @break
                        @case('agama')
                            @foreach(['Islam','Kristen Protestan','Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainnya'] as $agm)
                            <option value="{{ $agm }}">{{ ucfirst($agm) }}</option>
                            @if ($this->user->datadiri->agama != $agm)
                                <div wire:init='showin></div>
                            @endif
                            @endforeach
                            @break
                        @case('pendidikan_terakhir')
                            @foreach(['Tidak sekolah','SD', 'SMP/Sederajat', 'SMA/Sederajat', 'Diploma', 'S1', 'S2', 'S3'] as $pd)
                            <option value="{{ $pd }}">{{ ucfirst($pd) }}</option>
                            @endforeach
                            @break
                        @case('jenis_identitas')
                            @foreach (['ktp','sim','pasport'] as $ji)
                            <option value="{{ $ji }}">{{ ucfirst($ji) }}</option>
                            @endforeach
                            @break
                        @default
                    @endswitch
                    </select>
                    @if ($inputlain && $k === 'agama')
                        <input type="text" class="form-control" id="{{ $k }}" wire:model.defer="{{ $k }}">
                    @endif
                </div>
            @else
                <div class="form-group">
                    <label for="{{ $k }}">{{ ucfirst(str_replace('_', ' ', $k)) }}</label>
                    <input type="text" class="form-control" id="{{ $k }}" wire:model.defer="{{ $k }}">
                </div>
            @endif
            @endforeach
        {{-- <div class="form-group">
            <label>Date:</label>
              <div class="input-group date">
                  <input type="text" class="form-control datetimepicker-input"/>
                  <div class="input-group-append">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div> --}}
          <button type="submit" class="btn btn-block btn-primary btn-lg mt-4">Save</button>
        </div>
    
    </form>
    @if (session()->has('message'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            body: '{{ session('message') }}'
        })
    </script>
@endif

</div>