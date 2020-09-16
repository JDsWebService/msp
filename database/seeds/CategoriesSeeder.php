<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the Categories Table
        DB::table('categories')->delete();
        // Run the Portfolios Category Seeder
        factory(App\Models\Portfolio\Category::class, 6)->create();
    }
}
