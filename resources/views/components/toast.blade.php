@if(session('success'))
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" id="success-toast">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill p-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@elseif(session('info'))
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-info border-0 show" role="alert" aria-live="assertive" aria-atomic="true" id="info-toast">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <i class="bi bi-info-circle-fill p-2"></i>
                    {{ session('info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@elseif(session('error'))
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" id="info-toast">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <i class="bi bi-x-circle-fill"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif