<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;
    protected $table= 'cart_items';
    protected $fillable = ['cart_id', 'item_id', 'quantity','option'];

    public function Item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
