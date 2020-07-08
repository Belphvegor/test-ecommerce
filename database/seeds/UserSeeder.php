<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Costumer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('12345');
        $user->level = 'admin';
        $user->save();

        $u_costumer = new User();
        $u_costumer->name = 'costumer1';
        $u_costumer->email = 'costumer1@mail.com';
        $u_costumer->password = bcrypt('12345');
        $u_costumer->level = 'costumer';
        $u_costumer->save();

        $costumer = new Costumer();
        $costumer->user_id = $u_costumer->id;
        $costumer->nama = 'william';
        $costumer->tgl_lahir = date('Y-m-d', strtotime('03/02/1998'));
        $costumer->no_hp = '0895355634902';
        $costumer->jenkel = 'L';
        $costumer->email = 'williamafif123@gmailcom';
        $costumer->alamat = 'gowa';
        $costumer->image = $faker->imageUrl(640, 480);
        $costumer->save();
    }
}
