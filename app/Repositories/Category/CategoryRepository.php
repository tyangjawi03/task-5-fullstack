<?php

namespace App\Repositories\Category;

use App\Models\User;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepository
{
    public function all(): LengthAwarePaginator;
    public function storeCategory(User $user, $array): Category;
    public function updateCategory(Category $category, $array): Category;
    public function deleteCategory(Category $category): bool;
}
