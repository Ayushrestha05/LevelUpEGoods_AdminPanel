<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['category_id', 'item_name', 'item_description', 'item_image','additional'];

    public function Music(){
        return $this->hasOneThrough(Music::class,Item::class,'id','item_id');
    }

    public function MusicTracks(){
        return $this->hasManyThrough(MusicTrack::class,Item::class,'id','item_id');
    }

    public function GiftCard(){
        return $this->hasManyThrough(GiftCard::class,Item::class,'id','item_id');
    }

    public function Figurine(){
        return $this->hasOneThrough(Figurine::class,Item::class,'id','item_id');
    }

    public function FigurineImages(){
        return $this->hasManyThrough(FigurineImages::class,Item::class,'id','item_id');
    }
}
