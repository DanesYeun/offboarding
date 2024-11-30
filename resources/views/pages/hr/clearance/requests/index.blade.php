@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
        <h2 class="text-primary text-start">
            Manage Clearance
        </h2>

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('clearance.index')}}">Clearance Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('request.index')}}">Requests</a>
            </li>
        </ul>
        <x-clearance-requests-table label="Requests" :datas="$users"/>
    </div>
@endsection

@section('js')
@endsection