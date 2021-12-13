<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    public function store(Request $request)
    {

        $question_name = $request->question;
        $option = explode(',',$request->options);
        $correct_answer = $request->correct;
        $question = Question::create([
            'question_name' => $question_name,
            'correct_answer' => $correct_answer,
            'added_by' => auth()->user()->id,
        ]);
        if(!empty($option)){
            foreach ($option as $key => $value) {
                $question->options()->create([
                    'option_name' => $value
                ]);
            }
        }

        return response()->json(['status' => 'ok'],200);
    }

    public function getQuestion(){
        $user_id = auth()->user()->id;
        $lastAttempt = Progress::where('user_id',$user_id)->orderBy('id','desc')->first();
        $question = Question::where('id','>',$lastAttempt->question_id ?? 0)->with('options')->first();
        return response()->json(['status' => 'ok','data' => $question],200);
    }
}
