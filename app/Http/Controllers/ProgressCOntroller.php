<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressRequest;
use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function store(ProgressRequest $request){
        $progress = new Progress;
        $progress->user_id = Auth::user()->id;
        $progress->question_id = $request->input('question_id');
        $progress->status = $request->input('status');
        $result = $progress->save();
        if($result){
            return response()->json(['message'=>'saved successfully','CreatedData'=>$progress],201);
            }else{
                return response()->json(['message'=>'something went wrong'],404);
            }
    }

    public function show($id){
        $lastData = Progress::where('user_id',$id)->latest()->first();
        $score = count(Progress::where('status','1')->get());
        return response()->json(['lastData'=>$lastData,'score'=>$score],200);
    }
}
