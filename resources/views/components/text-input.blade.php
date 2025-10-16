@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-border focus:border-primary bg-inputBackground focus:ring-indigo-500 rounded-md shadow-sm']) }}>
