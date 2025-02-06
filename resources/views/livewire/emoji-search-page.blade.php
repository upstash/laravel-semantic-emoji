<div>
    <h1 class="text-4xl text-center text-black font-bold dark:text-white pb-20">
        Emoji Semantic Search
    </h1>
    <div class="mb-8 relative">
        <div class="flex items-center justify-center animate-wiggle absolute right-0 top-0 bottom-0 mr-4">
            <span wire:loading.delay wire:target="search">⏳</span>
        </div>
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            value="{{ $search }}"
            {{ $search == '' ? 'autofocus' : '' }}
            class="border border-slate-200 bg-slate-50 rounded-lg pl-5 pr-10 py-3 w-full dark:bg-slate-800 dark:border-slate-700 outline-none focus:ring-2 focus:ring-green-700"
            placeholder="Search for an emoji...">
    </div>
    <div class="mb-8 grid gap-1">
        <span class="text-xs pb-2">Example keywords:</span>
        <div class="flex flex-wrap gap-2">
            @foreach($exampleKeywords as $keyword)
                <button
                    type="button"
                    @class([
                        'text-sm border rounded-full px-2 py-0.5 focus:ring-2 focus:ring-green-700 outline-none hover:ring-2 hover:ring-green-700 cursor-pointer',
                        'text-white dark:border-green-600 bg-green-700' => $search === $keyword,
                        'dark:border-slate-700 border-slate-200 dark:bg-slate-800 bg-slate-50' => $search !== $keyword,
                    ])
                    wire:key="{{ $keyword }}"
                    wire:loading.attr="disabled"
                    wire:click="$set('search', '{{ $keyword }}')"
                >
                    {{ $keyword }}
                </button>
            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6">
        @foreach($emojis as $emoji)
            <button
                type="button"
                wire:key="{{ $emoji }}"
                x-data="{ copyText: '{{ $emoji }}', copied: false }"
                x-on:click="navigator.clipboard.writeText(copyText); copied = true; setTimeout(() => copied = false, 2000);"
                title="Copy {{ $emoji }} to clipboard"
                class="relative cursor-pointer border dark:bg-slate-800 dark:border-slate-700 border-slate-200 bg-slate-50 rounded-lg aspect-square flex items-center justify-center text-6xl outline-none focus:ring-2 focus:ring-green-700 hover:ring-2 hover:ring-green-700"
            >
                <div x-cloak x-show="copied" class="absolute text-sm rounded-lg bg-green-800 text-white px-2 py-1">Copied</div>
                <span x-show="!copied">{{ $emoji }}</span>
            </button>
        @endforeach
    </div>
</div>
