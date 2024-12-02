@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        <h2 class="text-primary text-start">
            Manage Clearance
        </h2>

        @if(session('error'))
            <x-toast :message="session('success')" :type="'success'" :icon="'bi-check-circle-fill'" />
        @elseif(session('success'))
            <x-toast :message="session('error')" :type="'danger'" :icon="'bi-exclamation-circle-fill'" />
        @endif

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('clearance.index')}}">Clearance Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('clearance_request.index')}}">
                    Requests
                    @if($count_new_requests > 0)
                        <span class="badge bg-warning ms-2">{{ $count_new_requests }}</span>
                    @endif
                </a>
            </li>
        </ul>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Add Clearance Form
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @if($employment_types && count($employment_types) > 0)
                            <form method="post" id="clearance-form" action="{{route('clearance.store')}}"  class="needs-validation" novalidate>
                                @csrf
                                <div class="container row">
                                    {{-- <h4 class="py-2 text-primary text-start">Clearance Form</h4> --}}
                                    
                                    <x-select name="employment_type" label="Type Of Clearance" :options="$employment_types" required="true" sizeMd="6" />

                                    <x-input name="statement" label="Statement" type="text" mdSize="6" required="true"/>
                                    
                                    {{-- <x-textarea name="statement" label="Statement" /> --}}

                            
                                    <h5 class="py-2 text-primary text-start">Clearing Officials</h5>
                            
                                    {{-- Clearing Officials Table --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="clearing_officials_table">
                                            <thead>
                                                <tr>
                                                    <th>SeqNo</th>
                                                    <th>Title</th>
                                                    <th>Clearing Official</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <button type="button" id="add-row" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus-circle-fill"></i> Add Row
                                        </button>
                                    </div>
                            
                                    {{-- Submit Button --}}
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-floppy-fill p-2"></i> Save
                                        </button>   
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning" role="alert">
                                No clearance type available.
                            </div>
                        @endif
                  
                    </div>
                </div>
            </div>
        </div>
        <x-clearance-forms-table label="Clearance Forms" :datas="$forms"/>
    </div>
@endsection

@section('js')
<script>
    document.getElementById('add-row').addEventListener('click', function() {
        const tableBody = document.querySelector('#clearing_officials_table tbody');
        const newRow = `
            <tr>
                <td><input type="number" name="seqno[]" class="form-control"></td>
                <td><input type="text" name="title[]" class="form-control"></td>
                <td>
                    <x-select name="clearing_official[]" label="" :options="$subRoles" required="true" sizeMd="12"/>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>`;
        tableBody.insertAdjacentHTML('beforeend', newRow);
    });

    document.addEventListener('click', function(event) {
        if (event.target.closest('.remove-row')) {
            event.target.closest('tr').remove();
        }
    });

</script>
@endsection