<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;

class QuestionController extends Controller
{
    public function store(QuestionRequest $request,OptionRequest $req){
        $question = new Question;
        $question->question_name = $request->input('question_name');
        $question->correct_answer = $request->input('corrrect_answer');
        $result = $question->save();
       
        foreach($req->option as $re){
            $option = new Option; 
            $option->question_id = $req('question_id');
            $option->option = $re('option');
            $option->save();
        }
        if($result){
        return response()->json(['message'=>'Question created  successfully','CreatedData'=>$question],201);
        }else{
            return response()->json(['message'=>'something went wrong'],404);
        }

    }
    public function show($id){
        $question_answer = Question::findOrFail($id);
        $options = Option::where('question_id',$id);
          
    }
}
