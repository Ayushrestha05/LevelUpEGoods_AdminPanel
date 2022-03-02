<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Figurine extends Model
{
    use HasFactory;
    protected $table = 'figurines';
    protected $fillable = ['item_id','figure_height', 'figure_price','figure_description','figure_dimension'];
}
