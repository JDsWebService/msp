<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Portfolio\Category;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Portfolio\Image::class, function (Faker $faker) {
    // ---------------------
    // File/Image Columns
    // ---------------------
    // fileNameWithExt
    // fileName
    // extension
    // fileNameToStore
    // fullPath
    // publicPath

    // ---------------------
    // Meta Data Columns
    // ---------------------
    // title
    // width
    // height
    // taken_on
    // description

    $randomNumber = $faker->numberBetween(1, 500);
    $fileName = 'testImage' . $randomNumber;
    $extension = 'png';
    $fileNameWithExt = $fileName . '.' . $extension;
    $testPath = $faker->imageUrl(500, 500, 'cats', true, 'Maine Sky Pixels');
    $category = Category::inRandomOrder()->first();
    $title = $faker->words(3, true);
    $slug = Str::slug($title) . '-' . $faker->unixTime();
    return [
        // File/Image Columns
        'fileNameWithExt' => $fileNameWithExt,
        'fileName' => $fileName,
        'extension' => $extension,
        'fileNameToStore' => $fileNameWithExt,
        'fullPath' => $testPath,
        'publicPath' => $testPath,
        'title' => $title,
        'slug' => $slug,
        'width' => $faker->randomNumber(5),
        'height' => $faker->randomNumber(5),
        'taken_on' => $faker->dateTime(),
        'description' => $faker->paragraph(3),
        'category_id' => $category->id,
    ];
});
