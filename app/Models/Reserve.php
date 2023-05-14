<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'number',
        'reserve_date',
        'reserve_time'
    ];

    public function getRestaurantname() {
        return optional($this->restaurant)->name;
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public static function searchReserve($user_id, $restaurant_id) {
        $query = self::query();
        $query->where('user_id',"$user_id")->where('restaurant_id',"$restaurant_id");
        $results = $query->get();
        return $results;
    }

    public static function userReserve($user_id) {
        $query = self::query();
        $query->where('user_id',"$user_id");
        $results = $query->get();
        return $results;
    }

    public static function pastReserve($user_id) {
        $query = self::query();
        $query->where('user_id', "$user_id");
        $results = $query->get();
        return $results;
    }

    public static function restaurantReserve($restauran_id) {
        $query = self::query();
        $query->where('restaurant_id', "$restaurant_id");
        
    }

    public function getUsername() {
        return optional($this->user)->name;
    }

    public function user() {
        return $fhis->belongsTo(User::class);
    }
}
