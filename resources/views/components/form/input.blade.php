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

<div class="relative w-full mb-7 group">
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
            'class' => 'peer block w-full px-4 pt-6 pb-2.5 text-sm text-amber-50 bg-black/30 border rounded-xl appearance-none transition-all duration-300 ease-out focus:outline-none focus:bg-black/40 hover:border-amber-100/30 shadow-sm backdrop-blur-sm ' . 
            ($type === 'password' ? 'pr-11 ' : '') . 
            ($readonly 
                ? 'bg-black/50 cursor-not-allowed border-amber-100/5 text-amber-100/40 ' 
                : ($errors->has($name) 
                    ? 'border-red-400/60 focus:border-red-400 focus:ring-2 focus:ring-red-400/20 ' 
                    : 'border-amber-100/10 focus:border-[#d89a4e] focus:ring-2 focus:ring-[#d89a4e]/30 '
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
            ? 'text-red-400 peer-focus:text-red-400 font-medium' 
            : 'text-amber-100/50 peer-focus:text-[#d89a4e] font-medium' 
        }}"
    >
        {{ $label }} 
        @if($required) 
            <span class="text-red-400 font-bold ml-0.5">*</span> 
        @endif
    </label>

    <!-- Toggle Password Button (Otomatis muncul jika type="password") -->
    @if($type === 'password')
        <button 
            type="button" 
            onclick="
                let input = this.parentElement.querySelector('input');
                let eyeOpen = this.querySelector('.eye-open');
                let eyeClosed = this.querySelector('.eye-closed');
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                } else {
                    input.type = 'password';
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                }
            "
            class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-100/40 hover:text-[#d89a4e] transition-colors p-1"
            tabindex="-1"
        >
            <svg class="eye-open w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
            </svg>
            <svg class="eye-closed w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.7a3 3 0 0 0 4.24 4.24M6.5 6.7C4 8.3 2.5 12 2.5 12s3.5 7 9.5 7c1.8 0 3.3-.5 4.6-1.3M17.6 17.6C19.9 15.9 21.5 12 21.5 12s-1.3-2.6-3.7-4.5" />
            </svg>
        </button>
    @endif

    <!-- Error Message -->
    @error($name)
        <div class="absolute -bottom-6 left-1 flex items-center gap-1.5 mt-1 text-xs text-red-400 font-medium animate-[pulse_0.5s_ease-in-out]">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $message }}</span>
        </div>
    @enderror
</div>