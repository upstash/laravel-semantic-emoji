<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Queries\FindEmojisQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Upstash\Vector\Laravel\Facades\Vector;
use Upstash\Vector\VectorRange;

class EmojiController extends Controller
{
    public function index(Request $request, FindEmojisQuery $emojis)
    {
        $search = $request->query(key: 'q');

        if (! $search) {
            return response()->streamJson([
                'emojis' => $this->yieldEmojis(),
            ], encodingOptions: JSON_UNESCAPED_UNICODE);
        }

        $results = $emojis->query($search);

        return response()->json(['emojis' => $results], options: JSON_UNESCAPED_UNICODE);
    }

    private function yieldEmojis(): \Generator
    {
        if (Cache::has('emoji-data')) {
            yield from Cache::get('emoji-data');

            return;
        }

        $emojis = [];
        $results = Vector::rangeIterator(new VectorRange(limit: 500, includeMetadata: true));

        foreach ($results as $result) {
            $emoji = $result->metadata['emoji'];
            yield $emoji;
            $emojis[] = $emoji;
        }

        Cache::put('emoji-data', $emojis, now()->addMinutes(5));
    }
}
