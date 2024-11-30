@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->

        <h2 class="text-primary text-start">
            Manage Users
        </h2>
        
        <x-users-table label="Users" :datas="$users"/>
        <a href="{{ route('users.add') }}" class="btn btn-success mx-2"><i class="bi bi-file-earmark-plus-fill p-2"></i> Add User</a>
    </div>
@endsection

@section('js')
@endsection