@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="border rounded bg-white p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <x-toast/>
            <div class="border w-75 h-75 rounded row m-0 d-flex justify-content-center">
                <div class="my-2 col-12 d-flex justify-content-center align-items-center">
                    @if (!is_null($clearance_request))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill p-3"></i>
                            You can now claim your COE at the Human Resources office!
                        </div>
                    @else
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle-fill p-3"></i>
                            No COE found!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection