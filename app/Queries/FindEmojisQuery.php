<?php

namespace App\Queries;

use Illuminate\Support\Facades\Cache;
use Upstash\Vector\DataQuery;
use Upstash\Vector\Laravel\Facades\Vector;
use Upstash\Vector\VectorMatch;

class FindEmojisQuery
{
    public function query(string $query): array
    {
        $cacheKey = 'emoji-query:'.md5(strtolower($query));

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($query) {
            $results = Vector::queryData(new DataQuery(
                data: $query,
                topK: 6,
                includeMetadata: true,
            ));

            return collect($results)
                ->map(fn (VectorMatch $match) => $match->metadata)
                ->pluck('emoji')
                ->toArray();
        });
    }
}
