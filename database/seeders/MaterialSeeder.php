<?php

namespace Database\Seeders;

use App\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::create('Mini Dell');
        self::create('ASUS');
        self::create('Ipad Air 2');
        self::create('Ipad 3');
        self::create('Cable HDMI');
        self::create('Cable VGA');
        self::create('Adaptateur HDMI/VGA');
    }

    private static function create($name)
    {
        return Material::create([
            'name' => $name,
        ]);
    }
}
