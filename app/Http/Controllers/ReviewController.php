<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(ReviewRequest $request)
    {
        $user_id = Auth::id();
        $review = $request->all();
        $review = [
            'user_id' => $user_id,
            'restaurant_id' => $review['restaurant_id'],
            'star' => $review['star'],
            'review' => $review['review']
        ];
        Review::create($review);
        return back();
    }
}
