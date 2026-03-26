@props([
    'type' => 'text',
    'name',
    'label' => null,
    'placeholder' => null,
    'required' => false,
    'value' => null,
    'error' => null
])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'appearance-none rounded-lg relative block w-full px-3 py-3 border ' . 
            ($error ? 'border-red-500' : 'border-gray-300') . 
            ' placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm']) }}
    >
    
    @if($error)
        <p class="mt-1 text-sm text-red-500">{{ $error }}</p>
    @endif
</div> 