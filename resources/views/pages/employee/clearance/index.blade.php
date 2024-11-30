@extends('layouts.layout')

@section('content')
    @php
        $hasClearance = false;
    @endphp
    <div class="d-flex justify-content-center m-md-2">
        @if($hasClearance != 'true')
            <div class="border rounded bg-white p-4 w-100 d-flex align-items-center">
                <div class="col-12 text-start text-primary">
                    <h3 class="mb-3">Request Clearance Form</h3>
                    <form action="" class="needs-validation row m-0" noValidate>
                        <!-- DElete this, if naa na backend -->
                        @php
                            $clearance_types = [['id' => 1, 'name' => 'Teacher Clearance']]
                        @endphp

                        <x-select name="clearance" label="Clearance Types" :options="$clearance_types" required="true"/>
                        <x-input type="file" label="Upload File" name="attachment" required="true"/>
                        
                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" name="remarks" id="" cols="30" rows="5" style="resize:none;"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-success">
                                <i class="bi bi-floppy-fill p-2"></i>
                                Save
                            </button>
                        </div>
                    </form> 
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
        
    </div>
@endsection

@section('js')
@endsection