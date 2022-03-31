<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'item_id', 'quantity', 'option'];

    public function Item(){
        return $this->belongsTo('App\Models\Item');
    }

}
