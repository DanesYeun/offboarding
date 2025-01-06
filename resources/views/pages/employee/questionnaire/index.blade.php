@extends('layouts.layout')

@section('content')
    <div class="justify-content-center m-md-2 h-75">
        <div class="border rounded p-4 bg-white">
            <div class="w-100 h-100 d-flex flex-column py-2">
                <h2 class="text-primary text-start">Survey Questionnaire</h2>
                <form method="POST" action="{{ route('employee_clearance.questionnaire.store', $clearance_request->id) }}">
                    @csrf
                    @foreach ($questions as $question)
                    <div class="p-2">
                        <div class="row m-0 border rounded p-2 shadow">
                            <span class="text-primary text-start">{{ $question->question }}</span>
                                <div class="d-flex justify-content-around">
                                    <span>1</span>
                                    <span>2</span>
                                    <span>3</span>
                                    <span>4</span>
                                    <span>5</span>
                                </div>
                            <div class="p-2 d-flex justify-content-around">
                                <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" id="question_{{ $question->id }}_1" value="1">
                                <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" id="question_{{ $question->id }}_2" value="2">
                                <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" id="question_{{ $question->id }}_3" value="3">
                                <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" id="question_{{ $question->id }}_4" value="4">
                                <input class="form-check-input" type="radio" name="responses[{{ $question->id }}]" id="question_{{ $question->id }}_5" value="5">
                            </div>
                        </div>
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