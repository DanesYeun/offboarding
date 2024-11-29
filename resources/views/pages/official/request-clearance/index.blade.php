@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h2 class="text-primary text-start">
            Clearance Requests
        </h2>

        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
        
        <x-clearance-requests-table label="Request List" :datas="$users"/>
    </div>
@endsection

@section('js')
@endsection