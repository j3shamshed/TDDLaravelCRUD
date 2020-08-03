<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagmentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function anAuthorCanCreated()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author', [
            'name' => 'Jubayer',
            'dob' => '17/01/1987'
        ]);
        $author = Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob, 'Check carbon instance creation');
        $this->assertEquals('1987/17/01', $author->first()->dob->format('Y/d/m'));
    }
}
