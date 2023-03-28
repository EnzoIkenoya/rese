<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'genre_id',
        'area_id',
        'storemanager_id',
        'infomation',
        'image'
    ];

    public function favorites(){
    return $this->hasMany('App\Models\Favorite');
    }

    public function reserves(){
    return $this->hasMany('App\Models\Reserve');
    }

    public function reviews(){
    return $this->hasMany('App\Models\Review');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function genre() {
        return $this->belongsTo('App\Models\Genre');
    }
}
