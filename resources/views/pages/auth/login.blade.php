@extends('layouts.layout')

@section('content')
    <div class="row m-0 w-100 h-100">
        <div class="col-12 col-md-6 row m-0 d-flex align-items-center">
            <div><h1 class="text-primary">Welcome</h1>
                <span >A Web based Employee Off Boarding Clearance.</span>
            </div>    
        </div>
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
            <div class="border rounded bg-white w-75 shadow p-3 mx-md-5">     
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="post" action="{{url('process_login')}}" class="needs-validation" novalidate>
                    @csrf               
                    <x-floating-input type="text" name="email" label="Email"/>
                    <x-floating-input type="password" name="password" label="Password"/>

                       <!-- Forgot Password and Show Password -->
                        <div class="text-primary text-start mb-2">
                            <input type="checkbox" class="form-check-input" id="showPassword" name="showPassword" value="1">
                            <label for="showPassword" class="ms-2">Show Password</label>
                        </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Login</button>
                    </div>
                    <div class="mt-2">
                        <small>
                            <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
                        </small>
                        <code>/</code>
                        <small>
                            <a href="{{url('register')}}" class="text-decoration-none text-primary">Sign Up Here</a>
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