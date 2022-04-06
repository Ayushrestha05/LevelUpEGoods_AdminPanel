<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardItem extends Model
{
    use HasFactory;
    protected $table = 'reward_items';
    protected $fillable = ['item_name', 'reward_points', 'stock', 'item_image'];
}
