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
        ]);
        Categories::create([
            'category_name' => 'Illustrations',
        ]);
        Categories::create([
            'category_name' => 'Figurines',
        ]);
        Categories::create([
            'category_name' => 'Games',
        ]);
        Categories::create([
            'category_name' => 'Playstation Exclusives',
        ]);
        Categories::create([
            'category_name' => 'Switch Exclusives',
        ]);
        Categories::create([
            'category_name' => 'Music',
        ]);
        Categories::create([
            'category_name' => 'All Products',
        ]);

    }
}
