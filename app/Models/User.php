<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites(){
    return $this->hasMany(Favorite::class);
    }

    public function favorite_restaurants(){
        return $this->belongsToMany(Restaurant::class, 'favorites', 'user_id', 'restaurant_id');
    }

    public function is_favorite($restaurant_id){
        return $this->favorites()->where('restaurant_id', $restaurant_id)->exists();
    }

    public function reserves(){
    return $this->hasMany(Reserve::class);
    }

    public function is_reserve($restaurant_id){
        return $this->reserves()->where('restaurant_id', $restaurant_id)->exists();
    }

    public function reviews(){
    return $this->hasMany(Review::class);
    }

    public function is_review($restaurant_id, $user_id){
        return $this->reviews()->where('restaurant_id',$restaurant_id)->where('user_id', $user_id)->exists();
    }
}
