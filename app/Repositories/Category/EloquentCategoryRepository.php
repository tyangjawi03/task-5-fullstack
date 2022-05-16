<?php

namespace App\Repositories\Category;

use App\Models\User;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCategoryRepository implements CategoryRepository
{
    public function all(): LengthAwarePaginator
    {
        return Category::latest('updated_at')->paginate(5);
    }

    public function storeCategory(User $user, $array): Category
    {
        return $user->categories()->create($array);
    }

    public function updateCategory(Category $category, $array): Category
    {
        $category->update($array);
        return $category;
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}
