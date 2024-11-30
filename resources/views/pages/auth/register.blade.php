@extends('layouts.layout')

@section('content')
    <div class="row m-0 w-100 h-100">
        <div class="col-12 col-md-6 row m-0 d-flex align-items-center">
            <div><h1 class="text-primary">Register</h1>
                <span >A Web based Employee Off Boarding Clearance.</span>
            </div>    
        </div>
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
            <div class="border rounded bg-white w-75 shadow p-3 mx-md-5">     
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form method="post" action="{{route('process_register')}}" class="needs-validation" novalidate>
                    @csrf               
                        <x-input type="text" name="name" label="Name" mdSize="12"/>
                        {{-- <x-input type="text" name="username" label="Username" mdSize="12"/> --}}
                        <x-input type="email" name="email" label="Email" mdSize="12"/>
                        <x-input type="password" name="password" label="Password" mdSize="12"/>

                       <!-- Forgot Password and Show Password -->
                        <div class="text-primary text-start mb-2">
                            <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" value="1">
                            <label for="showPassword" class="ms-2">Show Password</label>
                        </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Register</button>
                    </div>
                    <div class="mt-2">
                        <code>Already have an account?</code>
                        <small>
                            <a href="/" class="text-decoration-none text-primary">Sign In Here</a>
                        </small>
                    </div>  
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Import password toggle js -->
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection