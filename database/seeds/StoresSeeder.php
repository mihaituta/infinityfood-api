<?php

use Illuminate\Database\Seeder;
use App\Store;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Str;

class StoresSeeder extends Seeder
{
    public function run()
    {

        // Storage::disk('cloudinary')->put('la-familiar/restaurant-images/' . uniqid() . time(), Storage::disk('local')->get('/public/restaurant-images/la-familiar/preview.png'));
        // (new UploadApi())->upload('public\storage\restaurant-images\la-familiar\preview.png', ['folder' => 'la-familiar/restaurant-images/']);

        $storesList = ['Demo', 'La Familiar', 'Ramen Korewa', 'Pizza Hut', 'Spartan', "McDonald's", "Domino's Pizza", 'KFC', 'Pizza Delivery'];
        $cities = ['Craiova', 'Bucharest', 'Cluj', 'Iasi'];

        //local database ids for dev and testing
        // $userIds = ['2', '4', '5', '6', '7', '8', '9', '10', '11'];

        //clearDB heroku user ids
        $userIds = ['15', '35', '45', '55', '65', '75', '85', '95', '105'];

        $previewDescriptions = [
            'Fast-food | Drinks | Desert',
            'Fast-food | Drinks | Romanian',
            'Soup | Traditional Japanese | Sushi',
            'Pizza | Italian | Drinks',
            'Fast-food | Greek | Drinks',
            'Fast-food | International | Desert',
            'Pizza | International | Italian',
            'Fast-food | International | Drinks',
            'Pizza | Italian | Drinks',
        ];

        foreach ($storesList as $key => $store) {
            $storeSlug = Str::slug($store, "-");

            // upload images from storage folder to cloudinary for every restaurant
            // cloudinary()->uploadApi()->upload(
            //     'database/seeds/seedsImages/restaurant-images/' . $storeSlug . '/preview.jpg',
            //     [
            //         'folder' => $storeSlug . '/restaurant-images/',
            //         "public_id" => "previewImage"
            //     ]
            // );

            // cloudinary()->uploadApi()->upload(
            //     'database/seeds/seedsImages/restaurant-images/' . $storeSlug . '/bg.jpg',
            //     [
            //         'folder' => $storeSlug . '/restaurant-images/',
            //         "public_id" => "backgroundImage"
            //     ]
            // );

            // cloudinary()->uploadApi()->upload(
            //     'database/seeds/seedsImages/restaurant-images/' . $storeSlug . '/logo.png',
            //     [
            //         'folder' => $storeSlug . '/restaurant-images/',
            //         "public_id" => "logoImage"
            //     ]
            // );

            Store::create([
                'name' => $store,
                'slug' => $storeSlug,
                'user_id' => $userIds[$key],
                'city' =>  $cities[array_rand($cities)],
                'previewDescription' => $previewDescriptions[$key],

                'previewImage' => $storeSlug . '/restaurant-images/previewImage',
                'backgroundImage' => $storeSlug . '/restaurant-images/backgroundImage',
                'logoImage' => $storeSlug . '/restaurant-images/logoImage',

                'contactText' => "We enjoy talking with those who order food on " . $store . " because that's how we find out what we should do better.That's why we encourage you to tell us what you like andwhat you don't when you order food from us.",

                'phone1' => '0761234567',
                'phone2' => '0763034589',
                'mail1' => 'support@' . $storeSlug . '.ro',
                'mail2' => 'client@' . $storeSlug . '.ro',

                'aboutText' => "What does " . $store . " offer? Possibility to enjoy deliciousdishes from restaurants in your area. A wide range of deliciousdishes are at your disposal with just a few clicks."
            ]);
        }
    }
}
