<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;


class ProgressController extends Controller
{
    public function store(Request $request){
        $progress = new Progress;
        $progress->user_id = Auth::user()->id;
        $progress->question_id = $request->question_id;
        $progress->status = $request->status;
        $result = $progress->save();
        if($result){
            $newQuestion = Question::where('id', '>', $request->question_id)->with('options')->first();
            return response()->json(['message'=>'saved successfully','data'=>$newQuestion],201);
            }else{
                return response()->json(['message'=>'something went wrong'],404);
            }
    }

    public function show($id){
        $userProgress = Progress::where('user_id', $id)->get();
        $userQuestion = Question::where('added_by', Auth::user()->id)->get();
        $data = $userProgress->toArray();
        $stat = [];
        $stat['score'] = 0;
        $stat['total'] = count($data);
        $stat['question_contributed'] = count($userQuestion);
        foreach($data as $key => $value){
            if($value['status'] == 1){
                $stat['score'] = $stat['score'] + 1;
            }
        }

        return response()->json($stat,200);
    }
}
