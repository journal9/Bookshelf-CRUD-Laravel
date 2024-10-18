<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_Member extends Model{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'book_id',
    ];
}

