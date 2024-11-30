@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
        <h2 class="text-primary text-start">
            Add User
        </h2>
        <div class="mx-0 mb-3 p-0">
            <form method="post" action="{{route('users.store')}}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-0 p-3">
                    <h4 class="py-2 text-primary text-start">User Information</h4>

                    @if(session('success'))
                        <x-toast :message="session('success')" :type="'success'" :icon="'bi-check-circle-fill'" />
                    @elseif(session('error'))
                        <x-toast :message="session('error')" :type="'danger'" :icon="'bi-exclamation-circle-fill'" />
                    @endif

                    <x-input name="name" label="Name" type="text" required="true"/>
                    {{-- @php
                        $isEmailUsed = false;
                    @endphp            --}}
                    <x-select name="role" label="Role" :options="$roles" required="true" sizeMd="3"/>      
                    <x-select name="subrole" label="Sub Role" :options="$subroles" sizeMd="3"/>
                    <x-input name="emailaddress" label="Email" type="email" required="true"/> 
                    {{-- <div class="col-md-6 col-12 d-flex align-items-center pt-md-3">
                        @if ($isEmailUsed == "true")
                            <span class="badge text-white rounded-pill text-bg-danger px-2">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Email is already used!
                            </span>
                        @else
                            <span class="badge text-white rounded-pill text-bg-success px-2">
                                <i class="bi bi-check-circle-fill"></i>
                                Email can be used!
                            </span>
                        @endif
                    </div> --}}
                    {{-- <x-input name="password" label="Password" type="password" required="true"/>
                    <x-input name="password_confirmation" label="Confirm Password" type="password" required="true"/> --}}


                    <div class="d-flex justify-content-end">   
                        <a href="{{ url()->previous() }}" class="btn btn-danger mx-2"><i class="bi bi-arrow-left-circle p-2"></i> Back</a>
                        <button type="submit" class="btn btn-success mx-2"><i class="bi bi-person-fill-add p-2"></i> Add User</button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/formValidation.js') }}"></script>
@endsection