@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="border rounded bg-white p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <div>
            </div>
            <div class="border w-75 h-75 rounded row m-0 d-flex justify-content-center">
                @php
                    // test variables, use proper variables lang ta sa backend
                    $hasCOE = true;
                    $message = 'You can now print your COE!';
                @endphp
                @if ($hasCOE === 'true')
                    <div class="my-2 col-12">
                        <x-alert message="{{ $message }}" color="danger"/>
                    </div>
                @else
                    <div class="my-2 col-12">
                        <x-alert message="{{ $message }}" color="success"/>
                        <div class="mt-5">
                            <button class="btn btn-lg btn-success">
                                <i class="bi bi-file-earmark-arrow-down-fill p-2"></i>
                                Download COE
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection