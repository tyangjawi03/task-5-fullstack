<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'image',
        'user_id',
    ];

    protected $with = [
        'category',
    ];

    /**
     * Get the user that owns the Post
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the Post
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
