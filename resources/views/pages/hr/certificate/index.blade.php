@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <div class="border bg-white w-75 h-75 rounded row m-0 d-flex justify-content-center">
                <div class="my-2 col-12">
                    <h3 class="text-primary mb-3">Generate Offboarding Certificate</h3>
                    <div class="row m-0">
                        <x-input name="name" label="Employee Name" type="text" mdSize="6"/>
                        @php
                            $roles = [['id' => 1, 'name' => 'Dragon'], ['id' => 2, 'name' => 'Minion']]
                        @endphp
                        <x-select name="role" label="Role" :options="$roles" required="true" mdSize="6"/>  
                        <x-input name="date" label="Departure Date" type="date" mdSize="12"/>

                        <button class="btn btn-lg btn-success ">
                            <i class="bi bi-award-fill p-2"></i>
                            Generate Certificate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection