<label>{{ $label ?? null}}</label>
<div class="form-group">
    <input type="{{ $type ?? "text" }}" class="form-control " id="{{ $id }} " name="{{ $name }}"
        placeholder="{{ $placeholder ?? null }}" value="{{ $value ?? null}}">
    <div class="invalid-feedback">
        Oh no! Email is invalid.
    </div>
</div>