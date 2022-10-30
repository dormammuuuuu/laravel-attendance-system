@props([
    'label' => 'label',
    'id' => 'id',
    'type' => 'type',
    'value' => 'value',
])


<div class="form-group" >
    <label for="{{ $id }}">{{ $label }}</label>
    <input class="form-field" type="{{ $type }}" name="{{ $id }}" id="{{ $id }}" value="{{ $value }}">
    @error($id)
        <p class="error">{{ $message }}</p>
    @enderror
</div>