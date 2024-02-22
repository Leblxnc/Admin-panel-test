<div class="container-fluid">
    <div>
        <label>Show only pending tasks:</label>
        <input type="checkbox" wire:model="pendingonly">
    </div>
    <div class="mb-3">
        <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Search...">
    </div>
    <div class="container-fluid">    
        <div class="table-responsive table-responsive-sm">
    <table class="table table-bordered">
      <thead>
        <tr style="text-align:center m-1">
            <th wire:click="sortir('email')">Email</th>
            <th wire:click="sortir('datadiri.nama_lengkap')">Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th wire:click="sortir('datadiri.no_telp')">No. Telp</th>
            <th>edit</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $data)
              <tr>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->datadiri->nama_lengkap }}</td>
                  <td>{{ $data->datadiri->jenis_kelamin }}</td>
                  <td>{{ $data->datadiri->no_telp }}</td>
                  <td><button class="btn btn-primary" wire:click="edit({{ $data->id }})">Edit</button></td>
              </tr>
          @endforeach
      </tbody>
  </table>
        </div>
    </div>
  <div class="flex flex-row mt-2">
    {{ $users->links() }}
  </div>

  </div>