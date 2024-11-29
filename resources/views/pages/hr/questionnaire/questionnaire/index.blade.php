@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
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
                        <form method="post" id="clearance-form" action="#" class="needs-validation" novalidate>
                            @csrf
                            <div class="container row">  
                                <x-textarea label="Question" name="question"/>

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

        <x-questions-table label="Questions" :datas="$users"/>
    </div>
@endsection

@section('js')
@endsection