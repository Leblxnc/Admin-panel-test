@extends('admin.layout.main')

@section('res')
@livewireStyles
@endsection

@section('scripts')
@livewireScripts
@endsection

@section('layouts')
<div class="card row m-2">
    <div class="card-body">
    <h1 class="text-2xl font-bold leading-tight text-gray-900">Edit User</h1>

    <div class="mt-6">
        {{-- include the Updateadmin component --}}
        @livewire('update-user', ['user' => $user, 'user_id' => $userId, 'kl' => $kl])
    </div>
    </div>
</div>
@endsection
