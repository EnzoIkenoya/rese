<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Reserve;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;


class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $area = Area::all();
        $genre = Genre::all();
        $restaurants = Restaurant::all();
        $param = [
            'user' => $user,
            'areas' => $area,
            'genres' => $genre,
            'restaurants' => $restaurants,
        ];
        return view('index',$param);
    }

    public function detail(Request $request)
    {
        $user_id = Auth::id();
        $restaurant_id = $request->restaurant_id;
        $restaurant = Restaurant::find($request->restaurant_id);

        $param = [
            'user_id' => $user_id,
            'restaurant' => $restaurant,
            
        ];
        return view('detail', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $input_area = $request->area;
        $input_genre = $request->genre;
        $input_content = $request->store_name;
        $restaurants = restaurant::doSearch($input_area, $input_genre, $input_content);

        $area = Area::all();
        $genre = Genre::all();

        $param = [
            'user' => $user,
            'areas' => $area,
            'genres' => $genre,
            'restaurants' => $restaurants,
            'input_area' => $input_area,
            'input_genre' => $input_genre,
            'input_content' => $input_content,
        ];
        return view('index',$param);
    }
}
