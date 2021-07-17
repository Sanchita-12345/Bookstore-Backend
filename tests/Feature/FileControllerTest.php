<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetBooks()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/displayBooks');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testGetParticularBook()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/displayParticularBook/3');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testUpdateBooks()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('PUT', '/api/updateBook/7',[
            "name"=>"Inferno",
            "author"=>"Dan Brown",
            "price"=> 1000,
            "quantity"=>5,
            "file"=>"http://books.google.com/books/content?id=9nloexmq6QsC&printsec=frontcover&img=1&zoom=5",
            "description"=>"WORLDWIDE BESTSELLER Harvard professor of symbology Robert Langdon awakens in an Italian hospitaldisoriented and with no recollection of the past thirty-six hoursincluding the origin of the macabre object hidden in his belongings. With a relentless female assassin trailing them through Florencehe and his resourceful doctorSienna Brooksare forced to flee. Embarking on a harrowing journeythey must unravel a series of codeswhich are the work of a brilliant scientist whose obsession with the end of the world is matched only by his passion for one of the most influential masterpieces ever writtenDante Alighieris The Inferno. Dan Brown has raised the bar yet againcombining classical Italian arthistoryand literature with cutting-edge science in this captivating thriller",
        ]);
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testSearchBookByAuthor()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/searchBooksByAuthor/Stephen King');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testSearchBookByTitle()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/searchbooks/Inferno');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testSearchBookByPrice()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/searchBooksbyPrice/1000');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testSortBooksHighToLow()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/sortBooksHighToLow');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testSortBooksLowToHigh()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/sortBooksLowToHigh');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testCartItem()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('GET', '/api/cart');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testAddToCart()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('PUT', '/api/addToCart/7');
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testRemoveFromCart()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('DELETE', '/api/removeFromCart/7');
     $response->assertStatus(200)->assertSuccessful();
    }
}
