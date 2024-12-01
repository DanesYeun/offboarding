@extends('layouts.layout')

@section('content')
    <x-toast />
    <div class="d-flex flex-column m-md-2">
        <h2 class="text-primary text-start">
            Manage Quetionnaire
        </h2>

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Responses</a>
            </li>
        </ul>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Add Question
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" id="clearance-form" action="{{ route('hr_questionnaire.store') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="container row">  
                                <x-textarea label="Question" name="question" required="true"/>

                                <div class="d-flex justify-content-end">   
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-floppy-fill p-2"></i>
                                        Save
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <x-questions-table label="Questions" :datas="$questions"/>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/formValidation.js') }}"></script>
    <script>
        // Clear any leading/trailing whitespace in the textarea when the page loads
        window.addEventListener('DOMContentLoaded', (event) => {
            const textarea = document.getElementById('question');
            if (textarea) {
                // Trim whitespace and reset the value if needed
                textarea.value = textarea.value.trim();

                // Log the trimmed value to check
                console.log('Trimmed value of the textarea:', textarea.value);
            }
        });
    </script>
@endsection