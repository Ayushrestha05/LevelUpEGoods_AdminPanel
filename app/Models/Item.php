<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';

    public function Music(){
        return $this->hasOneThrough(Music::class,Item::class,'id','item_id');
    }

    public function MusicTracks(){
        return $this->hasManyThrough(MusicTrack::class,Item::class,'id','item_id');
    }
}
