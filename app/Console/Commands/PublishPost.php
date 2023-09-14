<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Console\Command;
use App\Notifications\NewPostPublished;
use Illuminate\Support\Facades\Notification;

class PublishPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'Started at: ' . Carbon::now().PHP_EOL;

        $chunkSize = 100; // Adjust the chunk size as needed

        $this->post->NotPublished()
            ->PublishedAt()
            ->chunk($chunkSize, function ($posts) {
                foreach ($posts as $post) {
                    $post->is_published = true;
                    $post->is_draft = false;
                    $post->save();

                    if ($post->is_published) {
                        Notification::send(admin(), new NewPostPublished($post));
                    }
                }
        });

        echo 'Queue finished at: ' . Carbon::now().PHP_EOL;

    }
}
