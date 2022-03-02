<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FigurineImages extends Model
{
    use HasFactory;
    protected $table = 'figurine_images';
    protected $fillable = ['item_id','image_path'];
}
