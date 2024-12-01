@props(['label', 'datas' => null])
<div class="container mt-2 table-container p-2">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1 text-secondary">{{ $label }}</h5>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <div class="table-responsive">
        <table id="clearance-requests-table" class="display table table-hover table-striped table-borderless data-table">
            <thead class="rounded-top">
                <tr>
                    <th scope="col" class="p-3 bg-primary text-white">ID</th>
                    <th scope="col" class="p-3 bg-primary text-white">Type of Form</th>
                    <th scope="col" class="p-3 bg-primary text-white">Statement</th>
                    <th scope="col" class="p-3 bg-primary text-white">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($datas as $data)
                    <tr>
                        <td class="p-3">{{ $data->id }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->employment_type_desc->description }}</td>
                        <td class="p-3 d-none d-sm-table-cell">{{ $data->statement }}</td>
                        <td class="p-3">
                            <a class="btn btn-sm btn-secondary text-white" href="{{ route('clearance.details', ['id' => $data->id]) }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>    
                        </td>
                    </tr>
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
        paginateTable('clearance-requests-table', data, 5);
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
