<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Worker extends Model{
    
    public function orders() {
        return $this->hasMany(Order::class);
    }
}