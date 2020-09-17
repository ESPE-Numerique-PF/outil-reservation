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
        self::create('Informatique');
        self::create('Ordinateur', 'Informatique');
        self::create('Ipad', 'Informatique');
        
        self::create('Accessoire');
        self::create('Cable', 'Accessoire');
        self::create('Adaptateur', 'Accessoire');
        self::create('Divers', 'Accessoire');
    }

    private static function create($name, $parentName = null)
    {
        $parentId = null;
        if (isset($parentName)) {
            $parent = Category::where('name', 'like', '%' . $parentName . '%')->first();
            $parentId = $parent->id ?? null;
        }
        return Category::create([
            'name' => $name,
            'parent_category_id' => $parentId
        ]);
    }
}
