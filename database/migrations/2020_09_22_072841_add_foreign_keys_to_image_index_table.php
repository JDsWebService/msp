<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImageIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_index', function (Blueprint $table) {
            // Define Categories Key
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            // Define Original Image Key
            $table->foreign('original_id')
                ->references('id')
                ->on('image_originals')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            // Define Preview Image Key
            $table->foreign('preview_id')
                ->references('id')
                ->on('image_previews')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            // Define Thumbnail Image Key
            $table->foreign('thumbnail_id')
                ->references('id')
                ->on('image_thumbnails')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_index', function (Blueprint $table) {
            $table->dropForeign('image_index_category_id_foreign');
            $table->dropForeign('image_index_original_id_foreign');
            $table->dropForeign('image_index_preview_id_foreign');
            $table->dropForeign('image_index_thumbnail_id_foreign');
        });
    }
}
