<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id'];

    // Relationship with Category (One-to-Many)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Tags (Many-to-Many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
