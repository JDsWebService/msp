<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the Image Index Table
        Schema::create('image_index', function (Blueprint $table) {
            $table->id();
            // This information is passed as form data to the controller
            $table->string('title');
            $table->date('taken_on')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id');
            // This data is generated from inside the controller
            $table->string('slug');
            // This information is gathered by the ImageHandler Class
            $table->string('copyright')->nullable();
            $table->string('artist')->nullable();
            $table->string('x_resolution')->nullable();
            $table->string('y_resolution')->nullable();
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->unsignedBigInteger('original_id');
            $table->unsignedBigInteger('thumbnail_id');
            $table->unsignedBigInteger('preview_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_index');
    }
}
