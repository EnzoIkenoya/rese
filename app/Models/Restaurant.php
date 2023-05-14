<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

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
    return $this->hasMany(Favorite::class);
    }

    public function reserves(){
    return $this->hasMany(Reserve::class);
    }

    public function reviews(){
    return $this->hasMany(Review::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function getArea(){
        return '#' . optional($this->area)->name;
    }

    public function getGenre(){
        return '#' . optional($this->genre)->name;
    }

    public function is_reserve($restaurant_id, $user_id){
        return $this->reserves()->where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->exists();
    }

    public static function doSearch($area,$genre,$content){
        $query = self::query();
        if(!empty($area)) {
            $query->where('area_id',"$area");
        }
        if(!empty($genre)) {
            $query->where('genre_id',"$genre");
        }
        if(!empty($content)) {
            $query->where('name','like',"%{$content}%");
        }

        $results = $query->get();
        return $results;
    }

    public function is_reviews($restaurant_id) {
        return $this->reviews()->where('restaurant_id', $restaurant_id)->exists();
    }

    public function is_userReview($restaurant_id,$user_id) {
        return $this->reviews()->where('restaurant_id', $restaurant_id)->where('user_id', $user_id)->exists();
    }

    public static function searchRestaurant($user_id) {
        $query = self::query();
        $query->where('user_id', "user_id");
        $results = $query->first();
        return $results;
    }
}
