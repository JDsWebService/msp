<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // Run the Portfolio Categories Seeder
        $this->call(CategoriesSeeder::class);
        $this->call(PortfolioImagesSeeder::class);
    }
}
