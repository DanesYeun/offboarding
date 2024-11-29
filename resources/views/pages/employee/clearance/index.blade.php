@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2">
        <div class="border rounded bg-white p-2 w-100 d-flex align-items-center">
            <div class="col-12 text-start text-primary">
                <h3 class="mb-3">Request Clearance Form</h3>
                <form action="" class="needs-validation row m-0" noValidate>
                    <!-- DElete this, if naa na backend -->
                    @php
                        $clearance_types = [['id' => 1, 'name' => 'Teacher Clearance']]
                    @endphp

                    <x-select name="clearance" label="Clearance Types" :options="$clearance_types" required="true"/>
                    <x-input type="file" label="Upload File" name="attachment"/>
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
    </div>
@endsection

@section('js')
@endsection