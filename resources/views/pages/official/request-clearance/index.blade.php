@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h2 class="text-primary text-start">
            Clearance Requests
        </h2>
    

        <x-clearance-requests-table label="Request List" :datas="$clearanceRequest"/>
    </div>
@endsection

@section('js')
@endsection