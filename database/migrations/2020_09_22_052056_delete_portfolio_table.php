<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('portfolio');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // database\migrations\2020_09_08_194051_create_portfolio_table.php
        Schema::create('portfolio', function (Blueprint $table) {
            $table->id();
            // File/Image Columns
            $table->string('fileNameWithExt');
            $table->string('fileName');
            $table->string('extension');
            $table->string('fileNameToStore');
            $table->string('fullPath');
            $table->string('publicPath');
            // Meta Data Columns
            $table->string('title');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->date('taken_on')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        // database\migrations\2020_09_08_214039_update_portfolio_table_to_include_category_id_field.php
        Schema::table('portfolio', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
        });
        // database\migrations\2020_09_08_221134_update_portfolio_table_to_add_foreign_keys.php
        Schema::table('portfolio', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('SET NULL');
        });
        // database\migrations\2020_09_16_190904_add_slug_field_to_portfolio_table.php
        Schema::table('portfolio', function (Blueprint $table) {
            // Add the slug field to the Portfolio table
            $table->string('slug')->after('title');
        });
        // database\migrations\2020_09_16_201201_update_portfolio_table_to_make_category_required.php
        Schema::table('portfolio', function (Blueprint $table) {
            // Change Category ID Field To Required
            $table->unsignedBigInteger('category_id')->change();
        });
    }
}
