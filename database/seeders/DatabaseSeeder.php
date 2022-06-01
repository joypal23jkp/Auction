<?php

namespace Database\Seeders;

use App\Enums\ProductStatusEnum;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('products')->insert([
            'product_title' => $faker->name,
            'product_description' => $faker->paragraph(3),
            'product_base_price' => rand(1,10000),
            'product_status' => ProductStatusEnum::Available(),
            'product_author' => 2,
            'product_buyer' => 1,
            'product_sold_price' => rand(1, 100000)
        ]);
    }
}
