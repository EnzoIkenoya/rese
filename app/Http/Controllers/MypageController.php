<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $reserves = Reserve::userReserve($user->id);
        $pastreserves = Reserve::pastReserve($user->id);
        $restaurants = Auth::user()->favorites()->orderBY('created_at','desc')->get();

        $param = [
            'user' => $user,
            'reserves' => $reserves,
            'pastreserves' => $pastreserves,
            'restaurants' => $restaurants
        ];
        return view('mypage', $param);
    }
}
