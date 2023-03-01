<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function price()
    {
        return $this->hasOne(Price::class, 'book_id', 'book_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'book_id', 'book_id');
    }
}
