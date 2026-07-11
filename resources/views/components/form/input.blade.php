@props([
    'name' => null,
    'type' => 'text',
    'required' => false,
    'value' => null,
    'label' => 'Label',
    'readonly' => false,
    'id' => null,
])

@php
    $inputId = $id ?? $name;
@endphp

<div class="relative w-full mb-8 group">
    <!-- Input Field -->
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $inputId }}" 
        value="{{ old($name, $value) }}"
        placeholder=" " 
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes->merge([
            'class' => 'peer block w-full px-4 pt-6 pb-2.5 text-sm text-amber-950 bg-amber-50/40 border-2 rounded-xl appearance-none transition-all duration-300 ease-out focus:outline-none focus:bg-white hover:border-amber-300 shadow-sm ' . 
            ($readonly 
                ? 'bg-gray-100 cursor-not-allowed border-gray-200 text-gray-500 ' 
                : ($errors->has($name) 
                    ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/15 ' 
                    : 'border-amber-200 focus:border-amber-700 focus:ring-4 focus:ring-amber-700/15 '
                )
            )
        ]) }}
    >

    <!-- Animated Floating Label -->
    <label 
        for="{{ $inputId }}" 
        class="absolute left-4 top-4 z-10 origin-[0] -translate-y-3 scale-75 transform text-sm transition-all duration-300 ease-in-out cursor-text pointer-events-none 
        peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-3.5
        peer-focus:top-4 peer-focus:-translate-y-3 peer-focus:scale-75
        {{ $errors->has($name) 
            ? 'text-red-500 peer-focus:text-red-600 font-semibold' 
            : 'text-amber-800/70 peer-focus:text-amber-900 font-semibold' 
        }}"
    >
        {{ $label }} 
        @if($required) 
            <span class="text-red-500 font-bold ml-0.5">*</span> 
        @endif
    </label>

    <!-- Error Message -->
    @error($name)
        <div class="absolute -bottom-6 left-1 flex items-center gap-1.5 mt-1 text-xs text-red-500 font-medium animate-[pulse_0.5s_ease-in-out]">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $message }}</span>
        </div>
    @enderror
</div>