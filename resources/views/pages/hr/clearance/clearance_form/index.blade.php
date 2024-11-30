@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <!-- DElete this, if naa na backend -->
        @php
            $users = [];
        @endphp
        <h2 class="text-primary text-start">
            Manage Clearance
        </h2>

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('clearance.index')}}">Clearance Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('request.index')}}">Requests</a>
            </li>
        </ul>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Clearance Form
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" id="clearance-form" action="#" class="needs-validation" novalidate>
                            @csrf
                            <div class="container row">
                                <h4 class="py-2 text-primary text-start">Clearance Form</h4>
                                <x-input name="description" label="Description" type="text" mdSize="6" required="true"/>         
                                <x-select name="purpose" label="Purpose" :options="$purposes" required="true" sizeMd="6"/>    
                                <x-textarea label="Statement" name="statement"/>

                                <h5 class="py-2 text-primary text-start">Add Clearing Officials</h5>
                                <div class="table-responsive">                  
                                    <table class="table table-responsive table-bordered" id="clearing_officials_table">
                                        <thead class="rounded-top">
                                            <tr>
                                                <th class="rounded-start">SeqNo</th>
                                                <th>Priority</th>
                                                <th>Title</th>
                                                <th class="rounded-end">Clearing Official</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                        </tbody>
                                    </table>
                                </div> 
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
        <x-clearance-requests-table label="Clearance Form" :datas="$users"/>
    </div>
@endsection

@section('js')
@endsection