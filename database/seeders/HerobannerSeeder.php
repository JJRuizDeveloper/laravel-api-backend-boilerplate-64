<?php

namespace Database\Seeders;

use App\Models\Herobanner;
use App\Models\HerobannerLocale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HerobannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hero_banner = Herobanner::create([
            'background_uri' => 'https://www.usnews.com/object/image/0000016e-6547-d289-a37f-7f47c2e80001/191113-happyyoungemployee-stock.jpg?update-time=1573657273197&size=responsive640',
            'button_action_uri' => env('FRONTEND_URL'),
            'is_target_blank' => false,
        ]);

        HerobannerLocale::create([
            'locale' => 'en',
            'herobanner_id' => $hero_banner->id,
            'title' => 'We are online!',
            'text' => 'Discover more about us',
            'button_text' => 'View more',
        ]);

        HerobannerLocale::create([
            'locale' => 'es',
            'herobanner_id' => $hero_banner->id,
            'title' => '¡Estamos de estreno!',
            'text' => 'Descubre más sobre nosotros',
            'button_text' => 'Saber más',
        ]);
    }
}
