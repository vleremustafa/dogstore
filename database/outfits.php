<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('outfits', function ($table) {
    $table->id();
    $table->integer('category_id');
    $table->string('title');
    $table->string('photo')->nullable();
    $table->string('cost');
    $table->timestamps();
});