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
            <form method="post" action="#" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-0 p-3">
                    <h4 class="py-2 text-primary text-start">User Information</h4>

                    <x-input name="name" label="Name" type="text"/>
                    @php
                        $roles = [['id' => 1, 'name' => 'Human Resource']];
                    @endphp           
                    <x-select name="role" label="Role" :options="$roles" required="true"/>
                    <x-input name="emailaddress" label="Email" type="email" required="true"/> 

                    @php
                        $subroles = [['id' => 1, 'name' => 'Dragon']];
                    @endphp           
                    <x-select name="subrole" label="Sub Role" :options="$subroles" required="true"/>
                    

                    <x-input name="password" label="Password" type="password"/>
                    <x-input name="password_confirmation" label="Confirm Password" type="password"/>


                    <div class="d-flex justify-content-end">   
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