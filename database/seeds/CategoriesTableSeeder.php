<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        
        factory(Category::class, 5)->create();
        
        DB::table('categories')->insert([
            //'id'=>rand(0,9),
            'name'=> Str::random(10), //dos formas de generar randoms
            'description'=> str_random(50),
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
    }
}
