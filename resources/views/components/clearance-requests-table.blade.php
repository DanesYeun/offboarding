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
                    <th scope="col" class="p-3 bg-primary text-white">Comment</th>
                    <th scope="col" class="p-3 bg-primary text-white">Status</th>
                    <th scope="col" class="p-3 bg-primary text-white">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
             
                @foreach($datas as $data)

                    @php
                        $statusClass = match($data->status_description) {
                            'Disapproved' => 'text-bg-danger',
                            'Pending' => 'text-bg-warning', 
                            'Completed' => 'text-bg-success',
                            default => 'text-bg-secondary',
                        };

                        $isDisabled = $data->status_id != 1 ? 'disabled' : '';
                    @endphp
                  
                     @if($data->clearing_official_id == Auth::user()->sub_role)
                    <tr>
                        <td class="p-3">{{ $data->name }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->employment_description }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->clearance_purpose_description }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($data->created_at)->toFormattedDateString() }}</td>
                        @if($data->status_id == 1)
                        <td class="p-3 d-none d-sm-table-cell">{{'Waiting for HR Verification'}}</td>
                        @else
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->comment ?? 'No Comment'}}</td>
                        @endif
                        <td class="p-3">
                            <small class="badge rounded-pill text-bg-warning">Pending</small>
                        </td>
                       
                        <td class="p-3">
                            @if($data->status_id == 1)
                            <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye text-primary"></i> 
                            </button>
                            @else
                            <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye text-primary"></i> 
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endif

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
                                        <x-input type="text" name="requestedBy" label="Requested By" class="form-control" value="{{ $data->name }} {{ $data->name }}" readOnly="true" />
                                        <x-input type="text" name="clearanceType" label="Clearance Type" class="form-control" value="{{ $data->employment_description }}" readOnly="true"/>
                                        <x-input type="text" name="purpose" label="Purpose" class="form-control" value="{{ $data->clearance_purpose_description }}" readOnly="true"/>
                                        <x-input type="text" name="dateRequested" label="Date Requested" class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->toFormattedDateString() }}" readOnly="true"/>
                                        <x-input type="text" name="status" label="Status" class="form-control" value="{{ $data->status_description }}" readOnly="true"/>
                                        
                                        <div class="col-md-6 mb-3 mt-4">
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
                                        {{-- Comment add --}}
                                        <form action="{{ route('clearance.comment', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$data->id}}">
                                            <input type="hidden" name="clearing_official_id" value="{{Auth::user()->id}}">
                                           
                                            <x-textarea label="Comments" :datas="[]"  name="comment"/>
                                            {{-- user_id --}}
                                            @if(Auth::user()->role_id == 2)
                                                <button type="submit" class="btn btn-sm btn-success my-2">
                                                    <span class="d-none d-sm-inline">Comment</span>
                                                </button>
                                            @endif
                                            {{-- <x-input label="Comments" :datas="[]" type="text" name="test"/> --}}
                                        </form>
                                       
                                    </div>
                        
                                </div>
                                <div class="modal-footer">
                                    <!-- Approve Button -->
                                    <form action="{{ route('official_request.status', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <input type="hidden" name="request_id" value="{{$data->id}}">
                                        <input type="hidden" name="last_seqno" value="{{ $data->last_sequence}}">
                                        <input type="hidden" name="seqno" value="{{ $data->seqno}}">
                                       
                                        <button type="submit" class="btn btn-sm btn-success my-2" >
                                            <span class="d-none d-sm-inline">Approved</span>
                                        </button>
                                    </form>

                                    <!-- Disapprove Button -->
                                    <form action="{{ route('request.status', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="disapproved">
                                        <button type="submit" class="btn btn-sm btn-danger my-2" {{ $isDisabled }} style="display: none;">
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
