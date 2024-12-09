@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="text-start mx-2 text-primary">Edit User</h3>
            <a class="btn btn-danger col-2 mb-3 " href="{{ route('users.index') }}">
                <i class="bi bi-backspace-fill p-2"></i>
                <span class="d-none d-sm-inline">Back</span>
            </a>
        </div>     
        <div class="mx-2 mb-3 p-0">
            <form method="post" action="{{ route('users.update', ['id' => $userDetails->id])}}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-0 p-3">
                    <h4 class="py-2 text-primary text-start">User Information</h4>
                    @if(session('error'))
                        <x-toast :message="session('success')" :type="'success'" :icon="'bi-check-circle-fill'" />
                    @elseif(session('success')) 
                        <x-toast :message="session('error')" :type="'danger'" :icon="'bi-exclamation-circle-fill'" />
                    @endif
                    <x-input name="name" label="Name" type="text" value="{{ $userDetails->name }}"/>
                    <x-input name="email" label="Email Address" type="text" value="{{ $userDetails->email }}"/>
                    <x-select name="role" label="Role" :options="$roles" required="true" value="{{ $userDetails->role_id }}"/>
                    <x-select name="subrole" label="Sub Role" :options="$subroles" required="true" value="{{ $userDetails->sub_role }}"/>
                    <x-select name="user_stats" label="Status" :options="$user_stats" required="true" value="{{ $current_stat[0]->id  }}"/>
                    <div class="d-flex justify-content-end">   
                        <a href="{{ route('users.index') }}" class="btn btn-danger mx-2"><i class="bi bi-arrow-left-circle p-2"></i> Back</a>
                        <button type="submit" class="btn btn-success mx-2"><i class="bi bi-person-fill-down p-2"></i> Save Changes</button>
                    </div>
                    
                </div>
            </form>
        </div>    
    </div>
@endsection

@section('js')
@endsection