@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="border rounded bg-white p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <x-toast/>
            <div class="border w-75 h-75 rounded row m-0 d-flex justify-content-center">
                <div class="my-2 col-12">
                    @if (!is_null($clearance_request))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            You can now download your COE!
                        </div>
                    @else
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle-fill"></i>
                            No COE found!
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    @if ($clearance_request)
                        <a href="{{ route('employee_coe.download', $clearance_request->user_id) }}" class="btn btn-lg btn-success">
                            <i class="bi bi-file-earmark-arrow-down-fill p-2"></i>
                            Download COE
                        </a>
                    @else
                        <button class="btn btn-lg btn-secondary" disabled>
                            <i class="bi bi-file-earmark-arrow-down-fill p-2"></i>
                            Download COE
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection