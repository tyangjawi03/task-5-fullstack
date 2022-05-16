<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepository
{
    public function all(): LengthAwarePaginator;
    public function storePost(User $user, StorePostRequest $request): Post;
    public function updatePost(Post $post, UpdatePostRequest $request): Post;
    public function deletePost(Post $post): bool;
}
