<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WipeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:softwipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the database of all entires except for the users table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if(config('app.env') != 'local') {
            $this->info('Can not run this command in production!');
            return;
        }

        // Alert the user that they are wiping the database of all entries
        $this->alert('You are about to wipe all entries in the Database!');

        if($this->confirm('Do you wish to continue?')) {
            // Delete the entries in the Portfolio Images Table
            $this->deletePortfolioImages();
            // Delete the entries in Categories Table
            $this->deleteCategoriesEntries();
            // Show Completion Message
            $this->info('Command has been successfully executed!');
        } else {
            $this->info('Aborting Command. User does not wish to clear database!');
            return;
        }

    }

    // Delete the Portfolio Images from the `portfolios` table
    protected function deletePortfolioImages() {
        $this->comment('Deleting categories table!');
        DB::table('portfolio')->delete();
        $this->info('Categories table deleted');
    }

    // Delete the Portfolio Categories from the `categories` table
    protected function deleteCategoriesEntries() {
        $this->comment('Deleting categories table!');
        DB::table('categories')->delete();
        $this->info('Categories table deleted');
    }
}
