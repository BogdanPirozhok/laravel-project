<?php

namespace App\Models;

use App\Helpers\LfmHelper;
use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Traits\AttachableCategories;
use App\Repositories\Category\Traits\RelatedTaxonomies;
use App\Repositories\Sanitizers\PostRequestSanitizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Rinvex\Categories\Traits\Categorizable;

class Post extends Model implements CategorizedInterface
{
    use Categorizable;
    use RelatedTaxonomies;
    use AttachableCategories;
    use LfmHelper;

    protected $fillable = [
        'name', 'body', 'is_published', 'is_featured', 'cover_file_path', 'cover_file_name'
    ];


    protected $casts = [
        'body'      => 'array',
        'update_at' => 'datetime:d.m.Y',
    ];


    public function getAttachable(): string
    {
        return 'taxonomy';
    }

    /**
     * @param $request
     * @return mixed
     * @throws \EditorJS\EditorJSException
     */
    public static function saveOrCreate(Request $request)
    {
        $validated = PostRequestSanitizer::validateEditor($request);

        $post = Post::find($validated['id']);

        if (is_null($post) && intval($request->get('id')) !== 0) {
            abort(404);
        }

        if ($request->has('cover_file')) {
            $coverFile =
                (new Post)->handleFile(
                    $post,
                    $request->file('cover_file'),
                    '/shares/news',
                    [
                        'file_path' => 'cover_file_path',
                        'file_name' => 'cover_file_name'
                    ]
                );
        }


        $additionalArray = [
            'cover_file_path' => $coverFile['filePath'] ?? ($post->cover_file_path ?? null),
            'cover_file_name' => $coverFile['fileName'] ?? ($post->cover_file_name ?? null),
        ];


        if (is_null($post)) {
            $post = Post::create(
                array_merge($validated['data'], $additionalArray)
            );
        } else {
            $post->update(array_merge($validated['data'], $additionalArray));
        }

        self::syncRelations($post, [
            'taxonomy' => $post->getAttachableCategories([$request->get('taxonomy')])
        ]);

        return $post;
    }

    /**
     * @param Post $post
     * @param $params
     * @return Post
     */
    public static function syncRelations(Post $post, $params): Post
    {
        extract($params);

        if (isset($taxonomy)) {
            $post->categories()->sync($taxonomy);
        }

        return $post;
    }


    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
