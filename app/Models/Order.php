<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function costumer()
    {
        return $this->belongsTo('App\Models\Costumer', 'costumer_id');
    }

    public function details()
    {
        return $this->belongsToMany('App\Models\Product', 'order_details', 'order_id', 'product_id')->withPivot('jumlah', 'harga');
    }
}
