@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
        <h2 class="text-primary text-start">
            Manage Users
        </h2>
        <x-users-table label="Users" :datas="$users"/>
    </div>
@endsection

@section('js')
@endsection