<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('categories')->get()->count() == 0) {
            DB::table('categories')->insert([
                ['category_name' => 'Olahraga', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Musik', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Pakaian', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Handphone', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Pendidikan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Kecantikan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Hobi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Mobil', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Motor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['category_name' => 'Cuaca', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            ]);
        }
    }
}
