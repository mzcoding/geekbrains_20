<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'status',
        'image',
        'description'
    ];

    public function scopeStatus(Builder $query): Builder
    {
       if (request()->has('f')) {
           return $query->where('status', request()->query('f', 'draft'));
       }

       return $query;
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
