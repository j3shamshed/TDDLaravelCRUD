<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Books;

class BookManagmentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_book_can_added_to_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool TItle',
            'author' => 'Jubayer'
        ]);
        $book = Books::first();
        //$response->assertOk(); //enable causes 302 error
        $this->assertCount(1, Books::all());
        $response->assertRedirect($book->path());
    }
    /** @test */
    public function aTitleIsRequired()
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Jubayer'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function aAuthorIsRequired()
    {
        //$this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function aBookCanUpdated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'Cool title',
            'author' => 'Jubayer'
        ]);
        $book = Books::first();
        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Books::first()->title);
        $this->assertEquals('New Author', Books::first()->author);
        $response->assertRedirect($book->path());
    }

    /** @test */
    function aBookCanBeDeleted()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'Cool title',
            'author' => 'Jubayer'
        ]);
        $book = Books::first();
        $this->assertCount(1, Books::all());
        $response = $this->delete($book->path());
        $this->assertCount(0, Books::all());
        $response->assertRedirect('/books');
    }
}
