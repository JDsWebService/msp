<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the Portfolio Table
        DB::table('portfolio')->delete();
        // Run the Portfolio Seeder
        factory(App\Models\Portfolio\Image::class, 40)->create();
    }
}
