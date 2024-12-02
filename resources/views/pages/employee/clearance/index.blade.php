@extends('layouts.layout')

@section('content')
    <x-toast/>
    <div class="d-flex justify-content-center m-md-2"> 
        @if(is_null($clearance_request) || (in_array($clearance_request->status, [6])|| ($clearance_request->status == 5 && !is_null($clearance_request->generated_coe_path))))
            <div class="border rounded bg-white p-4 w-100 d-flex align-items-center">
                <div class="col-12 text-start text-primary">
                    <h3 class="mb-3">Request Clearance Form</h3>
                    <form action="{{ route('employee_clearance.store') }}" method="post" class="needs-validation row m-0" noValidate enctype="multipart/form-data">
                        @csrf
                        <x-select name="clearance_id" label="Clearance Type" :options="$employment_types" required="true"/>
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
            @if(in_array($clearance_request->status, [1]))
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
                        <p class="m-0">
                            <strong>Purpose: </strong> 
                            {{$clearance_request->clearance->employment_type_desc->description}}
                        </p>
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
                    <div class="d-flex justify-content-between">
                        <h3>Request Clearance</h3>
                        <div>
                            @if(in_array($clearance_request->status, [1,2,3]))
                                <span class="badge text-white rounded text-bg-info px-2">
                                    <i class="bi bi-exclamation-circle-fill pl-2"></i>
                                    In Progress
                                </span>
                            @elseif(in_array($clearance_request->status, [4,5]))
                                <span class="badge text-white rounded text-bg-warning pl-2">
                                <i class="bi bi-exclamation-circle-fill pl-2"></i>
                                    @if ($clearance_request->status == 4)
                                        Pending Questionnaire
                                    @else
                                        COE pending
                                    @endif
                                </span>
                            @endif 
                        </div>
                    </div>    
                    <div class="col-md-4 col-12 mb-2">
                        <div class="border p-2 rounded mb-3">
                            <small><strong>Clearance Details</strong></small><br>
                            <small>
                                <strong>Clearance Type:</strong><br>
                                {{$clearance_request->clearance->employment_type_desc->description}}
                            </small><br>
                            <small>
                                <strong>Purpose:</strong><br> 
                                {{ $clearance_request->clearance_purpose->description }}
                            </small><br>
                            <small>
                                <strong>Attachment/s:</strong>
                                <a href="{{ asset('storage/' . $clearance_request->attachment_file_path) }}" target="_blank">
                                    {{ basename($clearance_request->attachment_file_path) }}
                                </a>
                            </small><br>
                        </div>
                        @if ($clearance_request->status == 4)
                            <div class="p-2 d-flex">
                                <a href="{{ route('employee_clearance.questionnaire.index') }}" class="btn btn-success flex-fill">Proceed to Questionnaire</a>
                            </div>
                        @endif  
                    </div>
                    <div class="col-md-8 col-12">
                        @foreach ($clearance_approvals as $approval)
                            <div class="border p-2 mb-1 rounded">
                                <h5>{{$approval->sub_role->description}}</h5>
                                <small>{{$approval->comment ?? 'No comment' }}</small><br>
                                @if($approval->isApproved == 0)
                                    <span class="badge text-white rounded-pill text-bg-warning px-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        Waiting for approval
                                    </span>
                                @elseif($approval->isApproved == 1)
                                    <span class="badge text-white rounded-pill text-bg-success px-2">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Approved
                                    </span>
                                @endif 
                            </div>
                        @endforeach
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