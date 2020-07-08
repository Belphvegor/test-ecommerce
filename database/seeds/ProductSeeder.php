<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            $product = new Product();
            $product->nama = $faker->name;
            $product->harga = $faker->numberBetween(100000, 1000000);
            $product->stok = $faker->numberBetween(10, 100);
            $product->desc = $faker->realText(200, 1);
            $product->image = $faker->imageUrl(640, 480);
            $product->save();
        }
    }
}
