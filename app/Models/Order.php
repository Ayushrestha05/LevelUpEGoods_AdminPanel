<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'txn_id', 'amount', 'status','reciever_name','reciever_phone','reciever_city','reciever_address','sender_message','hidden','wrapped','sub_total','discount_percentage','discount_amount','total'];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
