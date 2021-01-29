<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachable = (new Post)->getAttachableCategories([], true);

        factory(Post::class, 50)
            ->create()
            ->each(function ($post) use ($attachable) {
                $post->categories()->sync($attachable->random());
            });
    }

}
