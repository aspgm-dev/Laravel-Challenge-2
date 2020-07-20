<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('tags')->get()->count() == 0) {
            DB::table('tags')->insert([
                ['tag_name' => 'Gitar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Drum', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Piano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Suling', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Bass', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Ban', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Mesin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Velg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Baju', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Celana', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Hijab', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Kacamata', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Pizza', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Donat', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Fried Chicken', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Rendang', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Baso', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Lari Pagi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Gym', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Badminton', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Basket', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Sepak Bola', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Samsung', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Apple', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Blackberry', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Oppo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['tag_name' => 'Xiaomi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ]);
        }
    }
}
