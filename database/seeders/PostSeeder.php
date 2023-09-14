<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Post seeder

        $countPost = 100;

        for ($i = 0; $i < $countPost; $i++) {
            Post::factory()->create();
        }
    }
}
