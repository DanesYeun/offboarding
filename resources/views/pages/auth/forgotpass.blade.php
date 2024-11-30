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
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="post" action="{{route('process_forgot_password')}}" class="needs-validation" novalidate>
                    @csrf               
                    <x-floating-input type="text" name="name" label="Name"/>
                    <x-floating-input type="text" name="email" label="Email"/>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg btn-primary">Reset Password</button>
                    </div>
                    <div class="mt-2">
                        <small>
                            <a href="/" class="text-decoration-none text-primary">Back to login</a>
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