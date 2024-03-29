<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $fillable = ['item_id','platform_id','price'];

    public function Platform(){
        return $this->belongsTo('App\Models\Platform');
    }
}
