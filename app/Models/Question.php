<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_name', 'correct_answer','added_by'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }


}
