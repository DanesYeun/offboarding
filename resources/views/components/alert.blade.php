@props(['message', 'color' => 'danger'])
<div class="alert alert-{{ $color }} alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle-fill"></i>
    {{ $message }}
</div>