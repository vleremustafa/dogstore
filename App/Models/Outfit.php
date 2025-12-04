<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Outfit extends Model{

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

}