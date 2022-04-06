<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    use HasFactory;
    protected $table = 'reward_histories';
    protected $fillable = ['user_id', 'reward_id', 'status'];

    public function RewardItem(){
        return $this->belongsTo(RewardItem::class, 'reward_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
