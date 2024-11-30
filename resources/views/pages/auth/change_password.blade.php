@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="border rounded bg-white p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <div>
            </div>
            <div class="border w-75 h-75 rounded row m-0 d-flex justify-content-center">
                <div class="my-2 col-12">
                            <h3>Change Password</h3>
                            <hr>
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        <form action="{{route('users.process_change_password')}}" method="POST" class="needs-validation row m-0" novalidate>
                            @csrf
                            
                            <x-input type="password" label="Current Password" name="password" mdSize="12" value="" required/>
                            <x-input type="password" label="New Password" name="new_password" mdSize="12" value="" required />
                           
                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-success">
                                    <i class="bi bi-floppy-fill p-2"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection