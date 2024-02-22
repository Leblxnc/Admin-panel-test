@extends('admin.layout.main')


@section('scripts')

@endsection
@section('layouts')
<div class="card row m-1">
    <div class="card-header">
        <h3 class="card-title">Users View</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body m-2">
                @livewire('data-users')
        </div>
</div>
@endsection