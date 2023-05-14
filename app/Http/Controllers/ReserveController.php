<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function create(ReserveRequest $request) {
        $user_id = Auth::id();
        $reserve = [
            'user_id' => $user_id,
            'Restaurant_id' => $request->restaurant_id,
            'number' => $request->number,
            'reserve_date'=>$request->date . " " . $request->reserve_date,
            'reserve_time'=>$request->time . " " . $request->reserve_time,
        ];
        Reserve::create($reserve);
        return view('done');
    }

    public function update(ReserveRequest $request) {
        unset($request->_token);
        $reserve = [
            'number' => $request->number,
            'reserve_date'=>$request->date . " " . $request->reserve_date,
            'reserve_time'=>$request->time . " " . $request->reserve_time,
        ];
        Reserve::find($request->reserve_id)->update($reserve);
        return back();
    }

    public function delete(Request $request) {
        Reserve::find($request->reserve_id)->delete();
        return back();
    }
}
