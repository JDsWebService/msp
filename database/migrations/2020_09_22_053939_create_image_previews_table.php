<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagePreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_previews', function (Blueprint $table) {
            $table->id();
            $table->string('storagePath');
            $table->string('storageFolder');
            $table->string('fileName');
            $table->string('extension');
            $table->string('fileNameToStore');
            $table->string('fullPath');
            $table->string('publicPath');
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
        Schema::dropIfExists('image_previews');
    }
}
