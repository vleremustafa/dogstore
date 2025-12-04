<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model{
    public $articles;

    public function __construct() {
        $this->articles=[];
    }
}