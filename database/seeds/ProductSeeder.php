<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Product');

        for($i = 0; $i < 100; $i++){

            DB::table('get_products')->insert([
                'sku' => $faker->regexify('[0-9]{8}'),
                'name' => $faker->randomElement([
                    'Sweater', 'Scarf', 'Pants', 'Fullcap', 'Shorts', 'LongsleeveShirt'
                ]),
                'price' => $faker->randomNumber($nbDigits = 2),
                'conditionCode' => $faker->randomElement([
                    'clear', 'isolated-clouds', 'scattered-clouds', 'overcast', 'light-rain', 'moderate-rain', 'heavy-rain',
                    'sleet', 'light-snow', 'moderate-snow', 'heavy-snow', 'fog', 'na'
                ])
            ]);

        }
    }
}
