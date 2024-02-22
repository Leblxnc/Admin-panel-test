<div class="container-fluid"  wire:poll.10s>
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
          <tr>
            <th wire:click="sortir('kode_permohonan')">Kode Permohonan</th>
            <th wire:click="sortir('datadiri.nama_lengkap')">Nama lengkap</th>
            <th wire:click="sortir('users.email')">Email</th>
            <th wire:click="sortir('dr_id')">Datadiri</th>
            <th wire:click="sortir('pm_id')">Data permohonan</th>
            <th>Download</th>
            <th wire:click="sortir('verifikasi')">Status Validasi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($permohonan as $data)
              <tr>
                  <td>{{ $data->kode_permohonan }}</td>
                  <td>{{ $data->user->datadiri->nama_lengkap }}</td>
                  <td>{{ $data->user->email }}</td>
                  <td>@livewire('data-diri-modal', ['data' =>$data->user->id], key('data-diri-modal-' . $data->pm_id))</td>
                  <td>@livewire('data-permohonan-modal', ['data' =>$data->user->id, 'perm' =>$data->pm_id], key('data-permohonan-modal-' . $data->pm_id))</td>
                  <td>@livewire('data-download', ['data' =>$data->user->id, 'perm' =>$data->pm_id], key('data-download-' . $data->pm_id))</td>
                  <td>@livewire('data-verifikasi', ['data' =>$data->user->id, 'perm' =>$data->pm_id], key('data-verifikasi-' . $data->pm_id))</td>
              </tr>
          @endforeach
      </tbody>
  </table>
        </div>
    </div>
  <div class="flex flex-row mt-2">
    {{ $permohonan->links() }}
  </div>

  </div>