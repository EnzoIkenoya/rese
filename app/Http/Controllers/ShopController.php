<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $restaurants = Restaurant::with('area')->get();
        return view('index',['restaurants' => $restaurants]);
    }

    public function detail()
    {
        return view('detail');
    }

    public function favorite()
    {
        
    }
}
