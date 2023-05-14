<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'star',
        'comment'
    ];

    public function getUsername() {
        return optional($this->user)->name;
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public static function searchReview($restaurant_id) {
        $query = self::query();
        $query->where('restaurant_id', "$restaurant_id");
        $results = $query->get();
        return $results;
    }
}
