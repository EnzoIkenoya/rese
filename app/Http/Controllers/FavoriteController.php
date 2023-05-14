<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function create(request $request) {
        $user = Auth::user();
        $restaurant_id = $request->restaurant_id;

        if (!$user->is_favorite($restaurant_id)) {
            $favorite = [
                'restaurant_id' => $restaurant_id,
                'user_id' => Auth::id()
            ];
            Favorite::create($favorite);
        }
        return back();
    }

    public function delete(Request $request) {
        $user = Auth::user();
        $restaurant_id = $request->restaurant_id;

        if($user->is_favorite($restaurant_id)) {
            $query = Favorite::query();
            $query->where('restaurant_id', "$restaurant_id")->where('user_id',$user->id)->delete();
        }
        return back();
    }
}
