@props([
    'label' => 'label',
    'id' => 'id',
    'type' => 'type',
    'value' => 'value',
])


<div class="form-group" >
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-{{$type}}">
        <input class="form-field" type="{{ $type }}" name="{{ $id }}" id="{{ $id }}" value="{{ old($id) }}" wire:model="{{$value}}" autocomplete="off">
    </div>
    @error($id)
        <p class="error">{{ $message }}</p>
    @enderror
    @error($value)
        <p class="error">{{ $message }}</p>
    @enderror
</div>