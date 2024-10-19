<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author_name',
        'published_year',
        'genre_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
