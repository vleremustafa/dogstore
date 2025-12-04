<?php
require "../vendor/autoload.php";

require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('workers', function($table){
    $table->id();
    $table->string('first_name',30);
    $table->string('last_name',30);
    $table->string('phone',30)->nullable();
    $table->string('email')->unique();
    $table->string('password')->unique();
    $table->boolean('status')->default(1);
    $table->timestamps();

});