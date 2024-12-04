@extends('layouts.layout')

@section('content')
    <div class="d-flex justify-content-center m-md-2 h-75">
        <div class="p-2 w-100 h-100 d-flex justify-content-center align-items-center">
            <div class="border bg-white w-75 h-75 rounded row m-0 d-flex justify-content-center">
                <div class="my-2 col-12">
                    <h3 class="text-primary mb-3">Generate Offboarding Certificate</h3>
                    <!-- Update form action to accept the selected employee ID -->
                    <form action="{{ route('request.generate.coe', ['id' => 'selected_id']) }}" method="POST" id="certificateForm" target="_blank">
                        @csrf
                        <div class="row m-0">
                            @php
                                // Map request IDs to user names
                                $options = $requests->map(function ($request) {
                                    return [
                                        'id' => $request->id,
                                        'name' => optional($request->user)->name ?? 'N/A'
                                    ];
                                })->toArray();
                            @endphp
                    
                            <x-select name="employee_id" label="Employee Name" :options="$options" required="true" mdSize="6"/>
                            <x-input name="employement_type" label="Employment Type" type="text" mdSize="6"/>
                            <x-select name="department" label="Department" :options="$departments" required="true" mdSize="6"/>
                            <x-input name="date" label="Departure Date" type="date" mdSize="6"/>
                    
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-lg btn-success" onclick="updateFormAction()">
                                    <i class="bi bi-award-fill p-2"></i>
                                    Generate Certificate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function updateFormAction() {
            // Get selected employee ID
            const employeeId = document.querySelector('select[name="employee_id"]').value;
            // Update the form action dynamically
            const form = document.getElementById('certificateForm');
            form.action = `{{ url('generate-certificate-of-employment') }}/${employeeId}`;

            //window.location.reload();
        }

    </script>
@endsection
