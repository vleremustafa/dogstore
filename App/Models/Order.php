<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function outfit()
    {
        return $this->belongsTo(Outfit::class);
    }

    public function costumer()
    {
        return $this->belongsTo(Costumer::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}