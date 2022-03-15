<?php


use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    public function testCartReturned()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);



        $response = $this->getJson('/api/cart/1');
        dd($response->getContent());

//            $token = Auth::attempt([
//            'email' => 'lewis@gmail.com',
//            'password' => 'password'
//        ]);
//        $headers = [
//            'Authorization' => 'Bearer ' . $token,
//            'Content-Type' => 'application/json'
//        ];

        dd($response->getContent());
        $response->assertStatus(200);
        dd($response->getContent());
        $response->assertJsonPath('data.cart_items.0.product_id');
    }
}
