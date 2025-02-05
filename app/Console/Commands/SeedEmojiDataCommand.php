<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Upstash\Vector\DataUpsert;
use Upstash\Vector\Index;
use Upstash\Vector\Laravel\Facades\Vector;

use function Laravel\Prompts\spin;

class SeedEmojiDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed:emoji-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Upstash Vector with Emoji Data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        spin(fn () => $this->seedEmojiData(), 'Seeding Emoji Data...');

        $this->info('Seeding Complete!');
    }

    private function seedEmojiData(): void
    {
        // load emoji data from disk
        $emojiData = File::get(storage_path('emoji_data.json'));

        // decode the json data and convert it into a collection
        $collection = collect(json_decode($emojiData, true));

        // map the collection to a DataUpsert object
        $collection = $collection->map(fn (array $data) => new DataUpsert(
            id: $data['id'],
            data: $data['data'],
            metadata: $data['metadata'],
        ));

        // break the collection into chunks of 200 items
        $collection = $collection->chunk(200);

        // upsert the data into the vector index
        $collection->each(function (Collection $collection) {
            Vector::upsertDataMany($collection->toArray());
        });
    }
}
