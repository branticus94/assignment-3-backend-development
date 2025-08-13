<div class="relative">
    @if($formId && $type === 'text')
    <button type="button"
        class="absolute top-0 right-0 flex h-full items-center pr-5"
        onclick="
                const input = document.getElementById('{{ $name }}'); 
                input.value = ''; 
                input.focus(); 
                @if($formId === 'filter-form')
                    document.getElementById('filter-form').submit();
                @endif
            ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    @endif
    <input
        type="{{ $type }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="w-full rounded-md py-2 px-3 pr-6 placeholder:text-slate-300 border-0 ring-1 ring-slate-500 focus:ring-2 focus:ring-yellow-600 outline-0" />
</div>