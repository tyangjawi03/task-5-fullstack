<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPostRepository implements PostRepository
{
    public function all(): LengthAwarePaginator
    {
        return Post::latest('updated_at')->paginate(5);
    }

    public function storePost(User $user, StorePostRequest $request): Post
    {
        $fileName = $this->saveImage($request);

        return $user->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'image' => $fileName
        ]);
    }

    public function updatePost(Post $post, UpdatePostRequest $request): Post
    {
        $fileName = $this->saveImage($request) ?? $post->image;

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'image' => $fileName
        ]);

        return $post;
    }

    public function deletePost(Post $post): bool
    {
        return $post->delete();
    }

    private function saveImage(FormRequest $request): string|null
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $fileName = Str::slug($request->title, '-') . '-' . $file->hashName();

        $file->storeAs('public', $fileName);

        return $fileName;
    }
}
