<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDescription extends Model
{
    use HasFactory;
    protected $table = 'game_descriptions';
    protected $fillable = ['item_id','release_date','trailer_url','image_url'];
    protected $dates = ['release_date'];

    public function Item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
