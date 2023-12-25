@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent focus:outline-none focus:border-solid focus:ring-0 outline-none border-solid border-slate-200 text-xs text-gray-800 placeholder:text-gray-400']) !!}>
