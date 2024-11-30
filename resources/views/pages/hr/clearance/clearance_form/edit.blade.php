@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">

        @if(session('success'))
            <x-toast :message="session('success')" :type="'success'" :icon="'bi-check-circle-fill'" />
        @elseif(session('error'))
            <x-toast :message="session('error')" :type="'danger'" :icon="'bi-exclamation-circle-fill'" />
        @endif

        <form method="post" id="clearance-form" action="{{route('clearance.update', ['id' => $form->id])}}"  class="needs-validation" novalidate>
            @csrf
            <div class="container row">
                <h4 class="py-2 text-primary text-start">Clearance Form Details</h4>
                
                <x-select name="employment_type" label="Type of Form" :options="$employment_types" required="true" value="{{ $form->employment_type }}"/>  
                <x-input name="statement" label="Statement" type="text" value="{{ $form->statement }}" mdSize="6" required="true"/>

        
                <h5 class="py-2 text-primary text-start">Add Clearing Officials</h5>
        
           
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
                            @forelse ($form->officials as $official)
                                <tr>
                                    <td>
                                        <input type="hidden" name="official_id[]" value="{{ $official->id }}">
                                        <input type="number" name="seqno[]" class="form-control" value="{{$official->seqno}}">
                                    </td>
                                    <td><input type="text" name="title[]" class="form-control" value="{{$official->title}}"></td>
        
                                    <td>
                                        <x-select name="clearing_official[]" label="" :options="$subRoles" required="true" sizeMd="12" :value="$official->clearing_official" />
                                    </td>
                                    <td>
                                        <a href="#;" class="btn btn-danger btn-sm remove-row" data-id="{{ $official->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No officials found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="button" id="add-row" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle-fill"></i> Add Row
                    </button>
                </div>

                <input type="hidden" name="deleted_ids" id="deleted_ids" value="">
        
                {{-- Submit Button --}}
                <div class="d-flex justify-content-end mt-3">
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-danger mx-2"><i class="bi bi-arrow-left-circle p-2"></i> Back</a> --}}
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy-fill p-2"></i> Save
                    </button>
                </div>
            </div>
        </form>
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

    // document.addEventListener('click', function(event) {
    //     if (event.target.closest('.remove-row')) {
    //         event.target.closest('tr').remove();
    //     }
    // });

    document.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.remove-row');
        if (removeButton) {
            const row = removeButton.closest('tr');
            const officialId = removeButton.dataset.id;

            // If an official ID exists, track it for deletion
            if (officialId) {
                const deletedIdsField = document.getElementById('deleted_ids');
                const currentDeletedIds = deletedIdsField.value ? deletedIdsField.value.split(',') : [];
                if (!currentDeletedIds.includes(officialId)) { // Prevent duplicates
                    currentDeletedIds.push(officialId);
                }
                deletedIdsField.value = currentDeletedIds.join(',');
            }

            // Remove the row from the table
            row.remove();
        }
    });





</script>
@endsection