<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    public function store(Request $request)
    {
        $question = $request->question;
        $options = $request->options;
        $correct = $request->correct;
        $question = Question::create([
            'question' => $question,
            'correct' => $correct,
        ]);
    }
}
