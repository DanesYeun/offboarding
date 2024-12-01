@extends('layouts.layout')

@section('content')
    <div class="justify-content-center m-md-2 h-75">
        <div class="border rounded p-4 bg-white">
            <div class="w-100 h-100 d-flex flex-column py-2">
                <h2 class="text-primary text-start">Survey Questionnaire</h2>
                <form method="POST" action="{{ route('employee_clearance.questionnaire.store', $clearance_request->id) }}">
                    @csrf
                    @foreach ($questions as $question)
                    <div class="p-2"></div>
                        <div class="row m-0 border rounded p-2 shadow">
                            <span class="text-primary text-start">{{ $question->question }}</span>
                            <x-textarea label="" name="responses[{{ $question->id }}]" />
                        </div>
                    @endforeach
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection

@section('js')
@endsection