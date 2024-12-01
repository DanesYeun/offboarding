@extends('layouts.layout')

@section('content')
    <x-toast/>
    <div class="d-flex justify-content-center m-md-2"> 
        @if(is_null($clearance_request))
            <div class="border rounded bg-white p-4 w-100 d-flex align-items-center">
                <div class="col-12 text-start text-primary">
                    <h3 class="mb-3">Request Clearance Form</h3>
                    <form action="{{ route('employee_clearance.store') }}" method="post" class="needs-validation row m-0" noValidate enctype="multipart/form-data">
                        @csrf
                        <x-select name="employment_type" label="Employment Type" :options="$employment_types" required="true"/>
                        <x-select name="purpose" label="Purpose" :options="$purposes" required="true"/>
                        <x-input type="file" label="Upload File" name="attachment" required="true" mdSize="12"/>
                        
                        <x-textarea name="remarks" label="Remarks"/>
                        <div class="col-12 text-end">
                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-floppy-fill p-2"></i>
                                Save
                            </button>
                        </div>
                    </form> 
                </div>      
            </div>
        @else
            @if(in_array($clearance_request->status, [1,3]))
            <div class="border rounded bg-white p-4 w-100 d-flex align-items-center">
                <div class="col-12 row m-0 text-start text-primary">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle-fill"></i>
                        Your request is has been submitted and is under review!
                    </div>
                    <div class="col-12 border rounded p-3">
                        <h5 class="d-flex justify-content-between">
                            <div>Request Details</div>
                            <small>{{ $clearance_request->created_at->diffForHumans() }}</small>
                        </h5>
                        <p class="m-0"><strong>Employment Type: </strong> {{$clearance_request->employmentType->description}}</p>
                        <p class="m-0"><strong>Purpose: </strong> {{$clearance_request->clearance_purpose->description}}</p>
                        <p class="m-0"><strong>Attachment: </strong> 
                            <a href="{{ asset('storage/' . $clearance_request->attachment_file_path) }}" target="_blank">
                                {{ basename($clearance_request->attachment_file_path) }}
                            </a>
                        </p>
                        <p class="m-0">
                            @if ($clearance_request->status == 1)
                                <span class="badge text-white rounded-pill text-bg-warning px-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    Waiting for approval
                                </span>
                            @else
                                <span class="badge text-white rounded-pill text-bg-danger px-2">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Denied
                                </span>
                            @endif     
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="border rounded bg-white p-4 w-100 d-flex align-items-center">
                <div class="col-12 row m-0 text-start text-primary">
                    <h3 class="mb-3 col-12">Request Clearance Form</h3>
                    <div class="col-md-4 col-12 mb-2">
                        <div class="border p-2 rounded">
                            <small><strong>Clearance Details</strong></small><br>
                            <small><strong>Clearance Type:</strong><br> SAMPLE</small><br>
                            <small><strong>Remarks:</strong><br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, veritatis!</small><br>
                            <small><strong>Attachment/s:</strong> samplefile.pdf</small><br>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="border p-2 mb-1 rounded">
                            <h5>Supply officer</h5>
                            <small>Lorem ipsum dolor sit amet.</small><br>
                            <span class="badge text-white rounded-pill text-bg-success px-2">
                                <i class="bi bi-check-circle-fill"></i>
                                Approved
                            </span>
                        </div>
                        <div class="border p-2 mb-1 rounded">
                            <h5>Supply officer</h5>
                            <small>Lorem ipsum dolor sit amet.</small><br>
                            <span class="badge text-white rounded-pill text-bg-danger px-2">
                                <i class="bi bi-x-circle-fill"></i>
                                Denied
                            </span>
                        </div>
                        <div class="border p-2 mb-1 rounded">
                            <h5>Supply officer</h5>
                            <small>Lorem ipsum dolor sit amet.</small><br>
                            <span class="badge text-white rounded-pill text-bg-warning px-2">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Waiting for approval
                            </span>
                        </div>
                        <div class="border p-2 mb-1 rounded">
                            <h5>Supply officer</h5>
                            <small>Lorem ipsum dolor sit amet.</small><br>
                            <span class="badge text-white rounded-pill text-bg-warning px-2">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Waiting for approval
                            </span>
                        </div>
                        <div class="border p-2 mb-1 rounded">
                            <h5>Supply officer</h5>
                            <small>Lorem ipsum dolor sit amet.</small><br>
                            <span class="badge text-white rounded-pill text-bg-warning px-2">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Waiting for approval
                            </span>
                        </div>
                    </div>
                </div>      
            </div>
            @endif
        @endif
        
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/formValidation.js') }}"></script>
@endsection