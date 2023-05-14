<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'restaurant_id'
    ];

    public function restaurant() {
        return $this->belongsTo(Favorite::class);
    }

        public function getArea(){
        return '#' . optional($this->area)->name;
    }

    public function getGenre(){
        return '#' . optional($this->genre)->name;
    }

}
