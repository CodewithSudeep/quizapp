<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    //

    public function getMe(Request $request){

        return response()->json(auth()->user());
    }

}
