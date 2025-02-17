# Semantic Search of Emojis using Laravel and Upstash Vector

This project was built as an exmaple of how you can use Upstash Vector together with Laravel to build semantic search. The domain chosen for this project was emoji data that was expanded with semantic information by an LLM.

## Data

The data used for populating the vector index can be found in the [`storage/emoji_data.json`](./storage/emoji_data.json) file.

This file contains around 1.8k emojies together with their semantic information.

## Upstash Vector

Upstash Vector is a serverless vector database that allows you to store and query vectors.

We used the [upstash/vector-laravel](https://github.com/upstash/vector-laravel) sdk to connect to the Index, this SDK offers a seamless integration with Laravel.

## The Code

We've built this project using:

-   [Tailwind CSS](https://tailwindcss.com/)
-   [Alpine JS](https://alpinejs.dev/)
-   [Laravel](https://laravel.com/)
-   [Livewire](https://livewire.laravel.com/)

The most important parts of the code and the examples of how to populate the vector index and implement semantic search can be found in [app/Console/Commands/SeedEmojiDataCommand.php](./app/Console/Commands/SeedEmojiDataCommand.php) and [app/Queries/FindEmojisQuery.php](./app/Queries/FindEmojisQuery.php).

To semantically search the index we used a embedding model while configuring our Upstash Vector index. After that, the following code can be used to query the index:

```php
use Upstash\Vector\Laravel\Facades\Vector;
use Upstash\Vector\DataQuery;

$results = Vector::queryData(new DataQuery(
    data: 'happy',
    topK: 10,
    includeMetadata: true,
));
```

For more information on our PHP SDK, Laravel SDK and Upstash Vector check out the [documentation](https://upstash.com/docs/vector/overall/getstarted).
