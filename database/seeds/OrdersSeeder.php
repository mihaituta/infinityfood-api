<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'status' => 1,
            'totalPrice' => '223.50',
            'menus' => '1x Coca cola 330ml can, 2x Crispy Burger, 2x Pizza Diavola, 1x Cheese pancakes with raspberry filling, 1x Breaded zucchini with garlic sauce',
            'name' => 'Mihai',
            'phone' => '0834759834',
            'city' => 'Bucharest',
            'address' => 'Example',
            'houseNr' => '52',
            'floor' => '4',
            'apartment' => '6',
            'information' => 'No onions in burgers please',

            //local database id for dev and testing
            // 'store_id' => '1'

            //clearDB heroku store id
            'store_id' => '5'
        ]);

        Order::create([
            'status' => 0,
            'totalPrice' => '345.44',
            'menus' => '2x Chiken breast on stick, 2x Dark cake, 2x Apple pie, 1x Strongbow Gold Apple 330ml, 1x Water Bucovina 500ml',
            'name' => 'Demo name',
            'phone' => '3425453453',
            'city' => 'Bucharest',
            'address' => 'Example address',
            'houseNr' => '22',
            'floor' => '2',
            'apartment' => '4',
            'information' => '',

            //local database id for dev and testing
            // 'store_id' => '1'

            //clearDB heroku store id
            'store_id' => '5'
        ]);
    }
}
