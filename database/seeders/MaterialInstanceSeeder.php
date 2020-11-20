<?php

namespace Database\Seeders;

use App\Material;
use App\MaterialInstance;
use Illuminate\Database\Seeder;

class MaterialInstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::createMany('Mini Dell', 'minidell_', 'Mini Dell', 10);
        self::createMany('ASUS', 'asus_', 'ASUS', 12);
        self::createMany('Ipad_Air_2', 'ipadair2_', 'Ipad Air 2', 15);
        self::createMany('Ipad_3', 'ipad3_', 'Ipad 3', 25);
        self::createMany('Cable HDMI', 'cablehdmi_', 'Cable HDMI', 10);
        self::createMany('Cable VGA', 'cablevga_', 'Cable VGA', 10);
        self::createMany('Adaptateur HDMI VGA', 'adaptateurhdmivga_', 'Adaptateur HDMI/VGA', 15);
    }

    public static function createMany($name, $reference, $materialName, $nb)
    {
        for ($i = 1 ; $i < $nb ; $i++) {
            self::create($name . ' ' . $i, $reference . sprintf('%08d', $i), $materialName);
        }
    }

    private static function create($name, $reference, $materialName)
    {
        $material = Material::where('name', 'like', $materialName)->first();
        if (isset($material))
            $material->materialInstances()->create([
                'name' => $name,
                'reference' => $reference
            ]);
    } 
}
