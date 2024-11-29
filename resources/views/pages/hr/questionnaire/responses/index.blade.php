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
                <a class="nav-link" aria-current="page" href="#">Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Responses</a>
            </li>
        </ul>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Name of the little shit
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container row"> 
                            @php
                                // referencing might change later, pero 1 accordion per tao ta
                                $responses = [
                                    ['question' => 'Lorem ipsum dolor sit.', 'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae aliquid esse voluptate eius distinctio odio!'],
                                    ['question' => 'Lorem ipsum dolor sit.', 'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae aliquid esse voluptate eius distinctio odio!'],]   
                            @endphp
                            @foreach ($responses as $response)
                                <div class="text-start">
                                    {{ $response['question'] }}
                                </div>
                                <strong class="text-start">Answer: </strong><p class="text-start">{{ $response['answer'] }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection