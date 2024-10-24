<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Book;

class BooksTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fetching_all_books_returns_paginated_response(): void
    {
        $all_books = Book::count();
        $response = $this->withHeaders([
           'authorization'=>"Bearer 35|3oSwcckXWkFJzb9I7A8sL0ZytbAgjWu9TmGoJkS7dac433c8"
        ])->get('/api/books/all')
        ->assertJsonCount(ceil($all_books / 5))
        ->assertStatus(200);
    }

    public function test_adding_duplicate_book_title_author_pair_returns_failed_response(): void
    {
        $data = [
            'title'=>"September",
            'author_name'=>"Taylor Swift",
            'genre_id'=>3,
            'published_year'=>2008
        ];
        $response = $this->withHeaders([
            'authorization'=>"Bearer 34|50BOFNR52O7kTjOJjnh7vANKNAtPj84uxfncsUG67c642dca"
         ])->postJson('api/books/add',$data)
         ->assertStatus(422);
    }
}

