<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCustomerRegistration()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('POST', '/api/customerRegistration',[
            "name"=>"lila",
            "phonenumber"=>9008315110,
            "pincode"=>721209,
            "locality"=>"village",
            "landmark"=>"near sbi bank",
            "address"=>"west bengal",
            "city"=>"gopalpur",
            "type"=>"Work"
        ]);
     $response->assertStatus(200)->assertSuccessful();
    }

    public function testOrderSuccessfull(){
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
                eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNjUxOTA1MiwiZXhwIjoxNjI2NTIyNjUyLCJuYmYiOjE2MjY1MTkwNTIsImp0aSI6IlYxZmNFQ2Z0MDhNYXhKZ1YiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.kWQoumIMtwmChkW9TsuLnkldVCmdGigzxhlK4sDGOWY'
        ])->json('POST', '/api/mail',[
            "orderNumber"=>"6579757500",
            "customer_id"=>2,
            "order_date"=>"2021-07-17 11.09.58"

        ]);
     $response->assertStatus(200)->assertSuccessful();
    }
}
