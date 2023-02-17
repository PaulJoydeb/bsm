<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }

    public function cateogry()
    {
        return $this->hasOne(Categorie::class, 'id', 'category_id');
    }

    public function price()
    {
        return $this->hasOne(Price::class, 'book_id');
    }
}
