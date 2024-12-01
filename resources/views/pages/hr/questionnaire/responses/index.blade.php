@extends('layouts.layout')

@section('content')
<div class="d-flex flex-column m-md-2">
    <h2 class="text-primary text-start">
        Manage Questionnaire
    </h2>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('hr_questionnaire.index') }}">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('hr_questionnaire.responses.index') }}">Responses</a>
        </li>
    </ul>

    <div class="accordion" id="accordionExample">
        @foreach ($clearance_requests as $key => $clearance_request)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                        {{ $clearance_request->user->name ?? 'Unknown User' }} <!-- Assuming clearance request has a user relationship -->
                    </button>
                </h2>

                <div id="collapse{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container row">
                            @foreach ($clearance_request->responses as $response)
                                <div class="text-start">
                                    <!-- Check if question exists before trying to access its text -->
                                    <strong>{{ $response->question ? $response->question->question : 'Question not found' }}</strong>
                                </div>
                                <strong class="text-start">Answer: </strong>
                                <p class="text-start">{{ $response->response }}</p> <!-- Assuming the answer is stored in 'response' column -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
@endsection
