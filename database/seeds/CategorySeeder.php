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
        $category = [];

        // Informatique
        $category['informatique'] = Category::create([
            'name' => 'Informatique'
        ]);

        $category['ordinateur'] = Category::create([
            'name' => 'Ordinateur',
            'parent_category_id' => $category['informatique']->id
        ]);

        $category['ipad'] = Category::create([
            'name' => 'Ipad',
            'parent_category_id' => $category['informatique']->id
        ]);

        // Accessoire
        $category['accessoire'] = Category::create([
            'name' => 'Accessoire',
            'parent_category_id' => $category['informatique']->id
        ]);

        $category['cable'] = Category::create([
            'name' => 'Cable',
            'parent_category_id' => $category['accessoire']->id
        ]);

        $category['adaptateur'] = Category::create([
            'name' => 'Adaptateur',
            'parent_category_id' => $category['accessoire']->id
        ]);

        $category['adaptateur_hdmi_vga'] = Category::create([
            'name' => 'Adaptateur HDMI/VGA',
            'parent_category_id' => $category['accessoire']->id
        ]);
        
    }
}
