<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrationPrice extends Model
{
    use HasFactory;
    protected $table = 'illustration_prices';
    protected $fillable = ['item_id', 'size', 'price'];
}
