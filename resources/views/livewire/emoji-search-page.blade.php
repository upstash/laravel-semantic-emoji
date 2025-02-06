<div>
    <h1 class="text-4xl text-center text-black font-bold dark:text-white pb-20">
        Emoji Semantic Search
    </h1>
    <div class="mb-10 relative">
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
    <div class="grid grid-cols-3 gap-6">
        @foreach($emojis as $emoji)
            <button
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
