<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'test_user_alex';
        $user->email = 'test@email.com';
        $user->password = 'password';
        $user->saveOrFail();

        $user = new User();
        $user->name = 'lewis';
        $user->email = 'lewis@email.com';
        $user->password = 'password';
        $user->saveOrFail();
    }
}
