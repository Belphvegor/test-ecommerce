<?php

use Illuminate\Database\Seeder;
use App\Libraries\GenerateRandomString;
use App\Models\Costumer;

class CostumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 29; $i++) {
            $costumer = new Costumer();
            $costumer->nama = $faker->name;
            $costumer->tgl_lahir = $faker->date('Y-m-d', 'now');
            $costumer->no_hp = $faker->phoneNumber;
            $costumer->jenkel = GenerateRandomString::gender();
            $costumer->email = $faker->email;
            $costumer->alamat = $faker->address                             ;
            $costumer->image = $faker->imageUrl(640, 480);
            $costumer->save();
        }
    }
}
