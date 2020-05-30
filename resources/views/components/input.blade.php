<div class="form-group">
    <label>{{ $label ?? null}}</label>
    <input type="text" class="form-control" id="name" name="{{ $name??null }}" maxlength="50">
    @error('name')
    <span class="help-block" style="color:red">{{$message??null}}</span>
    @enderror
</div>