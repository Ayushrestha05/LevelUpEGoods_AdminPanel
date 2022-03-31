<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'item_id', 'review', 'rating'];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Item(){
        return $this->belongsTo('App\Models\Item');
    }
}
