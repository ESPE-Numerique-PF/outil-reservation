<?php

namespace Database\Seeders;

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
        self::create('Informatique', 0);
        self::create('Ordinateur', 0, 'Informatique');
        self::create('Ipad', 1, 'Informatique');
        
        self::create('Accessoire', 0);
        self::create('Cable', 1, 'Accessoire');
        self::create('Adaptateur', 0, 'Accessoire');
        self::create('Divers', 2, 'Accessoire');
    }

    private static function create($name, $position = 0, $parentName = null)
    {
        $parentId = null;
        if (isset($parentName)) {
            $parent = Category::where('name', 'like', '%' . $parentName . '%')->first();
            $parentId = $parent->id ?? null;
        }
        return Category::create([
            'name' => $name,
            'position' => $position,
            'parent_category_id' => $parentId
        ]);
    }
}
