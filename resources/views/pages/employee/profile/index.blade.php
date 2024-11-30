@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2">
        <div class="border rounded bg-white p-2 w-75 d-flex align-items-center">
            <div class="p-2 w-100 row m-0">
                <div class="col-12">
                    <h3>User Profile</h3>
                    <hr>
                </div>
                <div class="border rounded mb-3" style="height: 100px;">
                    IMAGE HERE
                </div>
                <x-toast/>
                <form action="{{ route('profile.update', $profile->id) }}" method="POST" class="needs-validation row m-0" novalidate>
                    @csrf
                    <x-input type="text" label="Name" name="name" mdSize="6" value="{{ $profile->name }}"/>
                    <x-input type="email" label="Email" name="email" mdSize="6" value="{{ $profile->email }}" />
                    <x-input type="file" label="Profile Picture" name="profilePicture" mdSize="12" disabled="true" />               
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">
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
    <script src="{{ asset('js/formValidation.js') }}"></script>
@endsection