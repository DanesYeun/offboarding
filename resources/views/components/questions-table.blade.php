@props(['label', 'datas' => null])
<div class="container mt-2 table-container p-2">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1 text-secondary">{{ $label }}</h5>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <div class="table-responsive">
        <table id="questions-table" class="display table table-hover table-striped table-borderless data-table">
            <thead class="rounded-top">
                <tr>
                    <th scope="col" class="p-3 bg-primary text-white">ID</th>
                    <th scope="col" class="p-3 bg-primary text-white">Question</th>
                    <th scope="col" class="p-3 bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($datas as $data)
                    <tr>
                        <td class="p-3">{{ $data->id }}</td>
                        <td class="p-3">{{ $data->question }}</td>
                        <td class="p-3">
                            <a class="btn btn-sm btn-secondary text-white" href="javascript:void(0)" onclick="editQuestion({{ $data->id }}, '{{ $data->question }}')">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('hr_questionnaire.delete', $data->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger my-2">
                                    <i class="bi bi-exclamation-circle"></i>
                                    <span class="d-none d-sm-inline">Delete</span>
                                </button>
                            </form>
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
    function editQuestion(id, question) {
        var accordion = new bootstrap.Collapse(document.getElementById('collapseOne'), {
            toggle: true
        });

        document.getElementById('question').value = question;
        document.getElementById('question_id').value = id;

        const form = document.getElementById('clearance-form');
        form.action = `/questions/${id}`;
        
        const button = form.querySelector('button[type="submit"]');
        button.innerHTML = '<i class="bi bi-floppy-fill p-2"></i> Update';
    }

    document.addEventListener("DOMContentLoaded", function() {
        const data = @json($datas); 
        paginateTable('questions-table', data, 5);
        document.getElementById("searchInput").addEventListener("input", function() {
            searchTable("searchInput", "questions-table");
        });
    });
</script>
 {{-- for searchbox --}}
<script>
    document.getElementById("searchInput").addEventListener("input", function() {
        searchTable("searchInput", "questions-table");
    });
</script>
