<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=0; $i < 30; $i++) {

            DB::table('books')->insert([
                'title' => $faker->streetName(),
                'description' => $faker->realText(),
                'author' => $faker->name(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        }

        // DB::table('books')->insert([
        //     'title' => 'A Wrinkle in Time',
        //     'description' => 'A young girl goes on a mission to save her father who has gone missing after working on a mysterious project called a tesseract',
        //     'author' => "Madeleine L\' Engle",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);
    }
}
