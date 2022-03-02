<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illustration extends Model
{
    use HasFactory;
    protected $table = 'illustrations';
    protected $fillable = ['description', 'creator', 'user_id','item_id'];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
