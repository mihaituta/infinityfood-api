<?php

use Illuminate\Database\Seeder;
use App\Menu;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Str;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menus = [
            //starter x7 0-6
            'Tender chicken nuggets',
            'Breaded zucchini with garlic sauce',
            'Zorba salad',
            'Caesar salad',
            'Beans with fried onions',
            'Eggplant salad',
            'Breaded cheese with sesame',

            //main course x9 7-15
            'Grilled chicken legs',
            'Chiken breast on stick',
            'Pork collar and polenta',
            'Sweet pork ribs with potatoes',
            'Grilled pork tenderloin in sauce',
            'Sarmale in pickled cabbage leaves and polenta',
            'Chicken schnitzel',
            'Turkey schnitzel',
            "The master's table",

            //fastfood x9 16-24
            'Crispy Burger',
            'Grand Classic Burger',
            'Souvlaki',
            'Persian plateau',
            'Schnitzel menu',
            'Crispy menu',
            'Leonidas Pita',
            'Cheese gyro',
            'Burger Gyros',

            //pizza x8 25-32
            'Pizza quattro stagioni',
            'Pizza Diavola',
            'Piza Carnivora',
            'Pizza Hot Chorizo',
            'Pizza Light',
            'Pizza Rustic',
            'Pizza Crudo',
            'Pizza Romana',

            //dessert x8 33-40
            'Sour cherry jam',
            'Cherries semolina with milk',
            'Cheese pancakes with raspberry filling',
            'Ikea cheese pancake',
            'Apple pie',
            'Black forest',
            'Tira Misu',
            'Dark cake',

            //drinks x14 41-54
            'Coca cola 330ml can',
            'Coca Cola 330ml',
            'Coca Cola 500ml',
            'Fanta 500ml',
            'Pepsi 330ml can',
            'Pepsi 500ml',
            'Miranda 330ml can',
            'Heineken 500ml',
            'Strongbow Rose Apple 330ml',
            'Strongbow Gold Apple 330ml',
            'Strongbow Red Berries 330ml',
            'Strongbow Gold Apple 330ml can',
            'Strongbow Red Berries 330ml can',
            'Water Bucovina 500ml'
        ];

        $menusDescription = [
            //starter
            'Chiken, garlic, cheese, ketchup, eggs, black pepper, salt, flour',
            'Zucchini, flour, eggs, mustard, black pepper, salt, garlic, sunflower oil',
            'Tomatoes, cucumber, paprika, cheese, olives, black pepper, sunflower oil',
            'Chiken, cheese, toast, garlic, mayo sauce, sunflower oil, white pepper, salt',
            'Beans, onions, garlic',
            'Eggplant, onions, tomatoes',
            'Cheese, eggs, flour, sunflower oil, salt, sesame',

            //main course
            'Chiken legs, black pepper, salt',
            'Chiken, mushrooms, paprika, tomatoes, onions',
            'Pork collar, onions, mushrooms, garlic, sunflower oil, salt, black pepper',
            'Pork ribs, potatoes, bbq sauce, garlic, black pepper, salt',
            'Pork tenderloin, paprika sauce, garlic, black pepper, salt',
            'Minced meat, rice, pickled cabbage, onions',
            'Chiken, eggs, black pepper, salt, flour',
            'Turkey, eggs, black pepper, salt, flour',
            'Chiken, onions, paprika, tomato sauce, mushrooms, garlic',

            //fastfood
            "Bacon, lettuce, tomatoes, pickles, Jack's sauce, fries",
            'Beef, cheese, bacon, onions, tomatoes, lettuce, pickles, bbq sauce, fries',
            'Chiken or pork and cow, fries, lettuce, tomatoes, pickles, sour sauce, garlic sauce, veggies sauce, olive sauce, tzatziki, pita',
            'Chiken or pork and cow, pizza sauce, butter, yogurt, paprika, tomatoes, pita',
            'Schnitzel, fries, garlic sauce, white salad, pita',
            'Crispy chiken, fries, lettuce, garlic sauce, sour sauce, pita',
            'Chiken or pork and cow, lettuce, tomatoes, pickles, onions, tomatoes, garlic sauce, olives sauce, sour-sweet sauce, veggies sauce, pita',
            'Chiken or pork and cow, lettuce, tomatoes, pickles, red onions, tomatoes, garlic sauce, olives sauce, sour-sweet sauce, veggies sauce, pita',
            'Chiken or pork and cow, lettuce, pickles, fries, garlic sauce, sour-sweet sauce, pita',

            //pizza
            '100% mozzarella, ham, chorizo, mushrooms, green paprika',
            'Tomato sauce, bacon, praga ham, mushrooms, olives, paprika, mozzarella',
            'Tomato sauce, bacon, praga ham, sausages, egg, tomatoes, mozzarella',
            'Chorizo, tomatoes, onions, paprika',
            'Paprika, onions, tomatoes, corn, mushrooms',
            'Chiken, olives, onions, paprika',
            'Tomato sauce, mozzarella, parma ham, corn, mushrooms',
            'Tomato sauce, cheese, ham, jalapenos',

            //dessert
            'Eggs, milk, cherries, sugar',
            'Cherries, ilk, semolina, sugar, salt, ',
            'Cheese, sour cream, eggs, sugar, cherries, flour, lemon peel, orange peel',
            'Cheese, cherries, egg, sour cream, sugar',
            'Apples, sugar, nuts, sunflower oil, vanilla essence ',
            'Flour, sugar, Vegetal cream, hydrogenated palm oil, emulsifiers, soy lecithin, milk protein',
            'Vegetal cream, sugar, coffee, milk, eggs, cacao, susan, nuts, emulsifiers',
            'Cacao cream, vegetal cream, sugar, sesame, nuts, pistachio',

            //drinks
            'Refreshing, carbonated, caffeinated drink',
            'Refreshing, carbonated, caffeinated drink',
            'Refreshing, carbonated, caffeinated drink',
            'Refreshing, carbonated drink with orange juice',
            'Refreshing, carbonated, caffeinated drink',
            'Refreshing, carbonated, caffeinated drink',
            'Refreshing, carbonated, caffeinated drink',
            'Blonde beer',
            'Apple cider',
            'Gold apple cider',
            'Red fruit flavor cider',
            'Gold apple cider',
            'Red fruit flavor cider',
            'Water'
        ];

        foreach ($menus as $key => $menu) {
            $menuSlug = Str::slug($menu, "-");

            // upload images from storage folder to cloudinary for every menu
            // cloudinary()->uploadApi()->upload(
            //     'database/seeds/seedsImages/menu-images/' . $menu . '.jpg',
            //     [
            //         'folder' => 'la-familiar/menu-images/',
            //         "public_id" => $menuSlug
            //     ]
            // );

            // cloudinary()->uploadApi()->upload(
            //     'database/seeds/seedsImages/menu-images/' . $menu . '.jpg',
            //     [
            //         'folder' => 'demo/menu-images/',
            //         "public_id" => $menuSlug
            //     ]
            // );

            $type = '';

            switch ($key) {
                case 0:
                    $type = 'Starter';
                    break;
                case ($key <= 6):
                    $type = 'Starter';
                    break;
                case ($key <= 15):
                    $type = 'Main Course';
                    break;
                case ($key <= 24):
                    $type = 'Fastfood';
                    break;
                case ($key <= 32):
                    $type = 'Pizza';
                    break;
                case ($key <= 40):
                    $type = 'Dessert';
                    break;
                case ($key <= 54):
                    $type = 'Drinks';
                    break;
            }

            Menu::create([
                'name' => $menu,
                'description' => $menusDescription[$key],
                'price' => rand(5 * 100, 40 * 100) / 100,
                'type' =>  $type,
                'image' => 'demo/menu-images/' . $menuSlug,

                //local database id for dev and testing
                // 'store_id' => '1',

                //clearDB heroku store id
                'store_id' => '5',
            ]);

            Menu::create([
                'name' => $menu,
                'description' => $menusDescription[$key],
                'price' => rand(5 * 100, 40 * 100) / 100,
                'type' => $type,
                'image' => 'la-familiar/menu-images/' . $menuSlug,

                //local database id for dev and testing
                // 'store_id' => '2',

                //clearDB heroku store id
                'store_id' => '15',
            ]);
        }
    }
}
