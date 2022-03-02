<?php

namespace Database\Seeders;

use App\Models\Categories;
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
        Categories::create([
            'category_name' => 'Gift Cards',
            'category_color' => '#5e5e5e',
        ]);
        Categories::create([
            'category_name' => 'Illustrations',
            'category_color' => '#aa3eff',
        ]);
        Categories::create([
            'category_name' => 'Figurines',
            'category_color' => '#ffc226',
        ]);
        Categories::create([
            'category_name' => 'Games',
            'category_color' => '#736464',
        ]);
        Categories::create([
            'category_name' => 'Playstation Exclusives',
            'category_color' => '#008cff',
        ]);
        Categories::create([
            'category_name' => 'Switch Exclusives',
            'category_color' => '#ff3535',
        ]);
        Categories::create([
            'category_name' => 'Music',
            'category_color' => '#b4a2a2',
        ]);
        Categories::create([
            'category_name' => 'All Products',
            'category_color' => '#2a6a92',
        ]);

    }
}
