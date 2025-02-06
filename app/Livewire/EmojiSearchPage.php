<?php

namespace App\Livewire;

use App\Queries\FindEmojisQuery;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

class EmojiSearchPage extends Component
{
    #[Locked]
    public array $emojis = [];

    #[Url]
    public string $search = '';

    public function mount(FindEmojisQuery $emojisQuery)
    {
        $this->emojis = $emojisQuery->query($this->search ?? '');
    }

    public function updatedSearch(FindEmojisQuery $emojisQuery): void
    {
        $this->emojis = $emojisQuery->query($this->search ?? '');
    }

    public function render()
    {
        return view('livewire.emoji-search-page');
    }
}
