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
        $this->search = trim($this->search);
        $this->emojis = $emojisQuery->query($this->search ?? '');
    }

    public function render()
    {
        return view('livewire.emoji-search-page', [
            'exampleKeywords' => $this->getExampleKeywords(),
        ]);
    }

    private function getExampleKeywords(): array
    {
        return [
            'happy',
            'sad',
            'angry',
            'excited',
            'nervous',
            'surprised',
            'scared',
            'confused',
            'tired',
            'hungry',
            'thirsty',
            'sleepy',
            'bored',
            'relaxed',
            'energized',
            'confident',
            'proud',
        ];
    }
}
