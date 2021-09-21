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

        //id = 5 / 1
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_ADMIN
        ]);

        //id = 15 / 2
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 25 / 3
        User::create([
            'name' => '1',
            'email' => '1@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_ADMIN
        ]);

        //id = 35 / 4
        User::create([
            'name' => 'LaFamiliar',
            'email' => '2@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 45 / 5
        User::create([
            'name' => 'RamenKorewa',
            'email' => '3@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 55 / 6 
        User::create([
            'name' => 'PizzaHut',
            'email' => '4@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 65 / 7
        User::create([
            'name' => 'Spartan',
            'email' => '5@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 75 / 8 
        User::create([
            'name' => 'McDonalds',
            'email' => '6@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 85 / 9 
        User::create([
            'name' => 'DominosPizza',
            'email' => '7@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 95 / 10 
        User::create([
            'name' => 'KFC',
            'email' => '8@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);

        //id = 105 / 11 
        User::create([
            'name' => 'PizzaDelivery',
            'email' => '9@gmail.com',
            'password' => Hash::Make('123123'),
            'role_id' => User::ROLE_STAFF
        ]);
    }
}