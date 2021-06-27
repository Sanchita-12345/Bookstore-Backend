<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testValidCredentials(){
        $response = $this->json('POST','/api/register',[
            "fullname"=>"Sanchita Barik",
            "email"=>"sanchitabarik50@gmail.com",
            "password"=>"Sanchita@50",
            "mobile"=>"8067333179"
        ]);
        $response->assertStatus(201);
    }

    public function textExistingCredentials(){
        $response = $this->json('POST','/api/register',[
            "fullname"=>"Gauri Sen",
            "email"=>"gauraisen66@gmail.com",
            "password"=>"Gauri@66",
            "mobile"=>"9932487676"
        ]);
        $response->assertStatus(422);
    }

    
}
