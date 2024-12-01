@props(['label', 'name', 'value' => null, 'required' => false])
<div class="col-12 mb-2">
    <label for="{{ $name }}" class="mb-2 d-flex justify-content-start text-primary">{{ $label }}</label>
    <textarea 
        name="{{ $name }}" 
        class="form-control" 
        id="{{ $name }}" 
        cols="30" 
        rows="5" 
        style="resize: none;"
        @if($required) required @endif
    >
        {{ $value }}
    </textarea>  
    
    <div class="invalid-feedback text-start">
        <i class="bi bi-exclamation-circle-fill"></i>
        This field is required
    </div>
</div>

<script>
    // null the textarea
    window.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('{{ $name }}');
        if (textarea) {
            textarea.value = textarea.value.trim();
            if (textarea.value === "") {
                textarea.value = null;
            }
        }
    });
</script>