<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Informatique']);
        Category::create(['name' => 'Cable']);
        Category::create(['name' => 'PC']);
        Category::create(['name' => 'Portable']);
        Category::create(['name' => 'Tablette']);
        Category::create(['name' => 'Ipad']);
        Category::create(['name' => 'Ecran']);
        Category::create(['name' => 'Adaptateur']);
        Category::create(['name' => 'Accessoire']);
    }
}
