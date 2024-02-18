<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public function scopeSearch($query, $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('desc', 'like', "%$keyword%")
                    ->orWhere('writer', 'like', "%$keyword%")
                    ->orWhere('publisher', 'like', "%$keyword%");
            });
        });
    }

    public function scopeFilterByCategory($query, $categoryId)
    {
        return $query->when($categoryId, function ($query, $categoryId) {
            $query->where('category_id', $categoryId);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
