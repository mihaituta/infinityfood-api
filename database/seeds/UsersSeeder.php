<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
/**
 * Class RolesSeeder
 */
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        User::create(['name' => '1',
            'email'=>'1@yahoo.com',
            'password'=>Hash::Make('123123'),
            'status'=>User::STATUS_ACTIVE,
            'role_id'=>User::ROLE_ADMIN]);
    }
}
