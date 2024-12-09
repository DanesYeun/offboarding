@props(['label', 'datas' => null])
<div class="container mt-2 table-container p-2">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1 text-secondary">{{ $label }}</h5>
        @if(session('success'))
            <x-toast :message="session('success')" :type="'success'" :icon="'bi-check-circle-fill'" />
        @elseif(session('error'))
            <x-toast :message="session('error')" :type="'danger'" :icon="'bi-exclamation-circle-fill'" />
        @endif
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
    </div>
    <div class="table-responsive">
        <table id="clearance-requests-table" class="display table table-hover table-striped table-borderless data-table">
            <thead class="rounded-top">
                <tr>
                    <th scope="col" class="p-3 bg-primary text-white">Requested By</th>
                    <th scope="col" class="p-3 bg-primary text-white">Clearance</th>
                    <th scope="col" class="p-3 bg-primary text-white">Purpose</th>
                    <th scope="col" class="p-3 bg-primary text-white">Date Requested</th>
                    <th scope="col" class="p-3 bg-primary text-white">Status</th>
                    <th scope="col" class="p-3 bg-primary text-white">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
             
                @foreach($datas as $data)

                    @php
                        $statusClass = match($data->statusDesc->description) {
                            'Pending' => 'text-bg-warning', 
                            'Verified' => 'text-bg-secondary',
                            'Approved' => 'text-bg-primary',
                            'Pending Questionnaire' => 'text-bg-info',
                            'Completed' => 'text-bg-success',
                            'Disapproved' => 'text-bg-danger',
                        };

                        $isDisabled = $data->status != 1 ? 'style=display:none;' : '';
                    @endphp
                    <tr>
                        <td class="p-3">{{ $data->firstname }} {{ $data->user->name }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->clearance->employment_type_desc->description }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->clearance_purpose->description }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($data->created_at)->toFormattedDateString() }}</td>
                        <td class="p-3">
                                <small class="badge rounded-pill {{ $statusClass }}">
                                    {{ $data->statusDesc->description }}
                                    @if($data->status == 3 && $data->clearance_approvals->isNotEmpty())
                                        @php
                                            // Find the last record where isApproved is 1
                                            $lastApproved = $data->clearance_approvals->filter(fn($approval) => $approval->isApproved == 1)->last();
                                        @endphp
                                        @if($lastApproved && $lastApproved->sub_role)
                                            - {{ $lastApproved->sub_role->description ?? '' }}
                                        @endif
                                    @endif
                                </small>
                        </td>
                        <td class="p-3">
                            <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye text-primary"></i> 
                            </button>
                        </td>
                    </tr>

                    <!-- Modal for this particular clearance request -->
                    <div class="modal fade" id="viewModal{{ $data->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel{{ $data->id }}">Clearance Request Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <x-input type="text" name="requestedBy" label="Requested By" class="form-control" value="{{ $data->firstname }} {{ $data->user->name }}" readOnly="true" />
                                        <x-input type="text" name="clearanceType" label="Clearance Type" class="form-control" value="{{ $data->clearance->employment_type_desc->description }}" readOnly="true"/>
                                        <x-input type="text" name="purpose" label="Purpose" class="form-control" value="{{ $data->clearance_purpose->description }}" readOnly="true"/>
                                        <x-input type="text" name="dateRequested" label="Date Requested" class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->toFormattedDateString() }}" readOnly="true"/>
                                        {{-- <x-input type="text" name="status" label="Status" class="form-control" value="{{ $data->statusDesc->description }}" readOnly="true"/> --}}
                                        
                                        <div class="col-md-12 mb-3 mt-3">
                                            <div class="input-group">
                                                @if($data->attachment_file_path)
                                                    <input type="text" class="form-control" id="attachment" value="{{ basename($data->attachment_file_path) }}" readonly>
                                                    <div class="input-group-append">
                                                        <a href="{{ asset('storage/' . $data->attachment_file_path) }}" target="_blank" class="btn btn-outline-primary">
                                                            View Attachment
                                                        </a>
                                                    </div>
                                                @else
                                                    <input type="text" class="form-control" id="attachment" value="No attachment available" readonly>
                                                @endif
                                            </div>
                                        </div>
                                        <h5>Clearing Officials</h5>
                                        @foreach($data->clearance_approvals as $approver)
                                            <x-input type="text" name="approver" label="" class="form-control" value="{{ $approver->sub_role->description }}" readOnly="true" mdSize="9"/>
                                            <x-input type="text" name="approver" label="" class="form-control" value="{{ $approver->isApproved ? 'Approved' : 'Pending' }}" readOnly="true" mdSize="3"/>
                                        @endforeach
                                    </div>
                        
                                </div>
                                <div class="modal-footer">
                                    <!-- Approve Button -->
                                    <form action="{{ route('request.status', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success my-2" {{ $isDisabled }}>
                                            <span class="d-none d-sm-inline">Verify</span>
                                        </button>
                                    </form>

                                    <!-- Disapprove Button -->
                                    <form action="{{ route('request.status', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="disapproved">
                                        <button type="submit" class="btn btn-sm btn-danger my-2" {{ $isDisabled }}>
                                            <span class="d-none d-sm-inline">Disapprove</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="pagination-container">
        <ul class="pagination justify-content-end" id="pagination"></ul>
    </nav>
</div>

<script src="{{ asset('js/searchbox-table.js') }}"></script>
<script src="{{ asset('js/pagination.js') }}"></script>
 {{-- for pagination --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const data = @json($datas); 
        paginateTable('clearance-requests-table', data, 10);
        document.getElementById("searchInput").addEventListener("input", function() {
            searchTable("searchInput", "clearance-requests-table");
        });
    });
</script>
 {{-- for searchbox --}}
<script>
    document.getElementById("searchInput").addEventListener("input", function() {
        searchTable("searchInput", "clearance-requests-table");
    });
</script>
