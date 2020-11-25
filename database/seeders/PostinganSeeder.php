<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $faker = Faker::create('id_ID');

            for ($loop=1; $loop <101 ; $loop++) {
                DB::table('Komentar')->insert([
                    'id_post'=>$loop,
                    'komentar'=>$faker->text,
                ]);
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
