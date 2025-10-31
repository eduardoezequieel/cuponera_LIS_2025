@props([
    'id' => null,
    'name' => null,
    'checked' => false,
    'label' => '',
    'helper' => '',
    'disabled' => false,
])

<div {{ $attributes->merge(['class' => 'col-span-2']) }}>
    @if($label)
        <x-input-label :for="$id" :value="$label" />
    @endif

    <div class="inline-flex items-center gap-3 mt-2">
        <label for="{{ $id }}" class="relative inline-block w-11 h-6 cursor-pointer">
            <input
                type="checkbox"
                id="{{ $id }}"
                name="{{ $name }}"
                value="1"
                @if($checked) checked @endif
                @disabled($disabled)
                class="sr-only peer"
            />

            <div class="w-11 h-6 bg-border rounded-full peer-checked:bg-primary transition-colors duration-200"></div>
            <span class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-transform duration-200 peer-checked:translate-x-5"></span>
        </label>

        @if($helper)
            <label for="{{ $id }}" class="text-sm text-textMuted cursor-pointer">{{ $helper }}</label>
        @endif
    </div>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
