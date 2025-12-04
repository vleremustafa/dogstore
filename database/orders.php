<?php
require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\SoftDeletes;

Capsule::schema()->create('orders', function ($table) {
    $table->id();
    $table->integer('costumer_id');
    $table->integer('worker_id');
    $table->integer('outfit_id');
    $table->text('comment')->nullable();
    $table->timestamps();
    $table->softDeletes();
});