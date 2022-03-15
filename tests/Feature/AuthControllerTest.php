<?php


use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testUserCanRegister()
    {
        $faker = Faker\Factory::create();

        $headers = [
            'Content-Type' => 'application/json'
        ];

        $data = [
            "name" => $faker->name,
            "email" => $faker->email,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $response = $this->postJson('/api/register', $data, $headers);
        $response->assertStatus(201);
    }

//    public function testAuthorisationWorks()
//    {
//        $token = Auth::attempt([
//            'email' => 'lewis@gmail.com',
//            'password' => 'password'
//        ]);
//        $headers = [
//            'Authorization' => 'Bearer ' . $token,
//            'Content-Type' => 'application/json'
//        ];
//
//        $response = $this->getJson('/api/cart', $headers);
//        dd($response->getContent());
//        $response->assertStatus(200);
//    }
}
