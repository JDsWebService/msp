<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Run the Portfolios Category Seeder
        factory(App\Models\Portfolio\Category::class, 6)->create();
    }
}
