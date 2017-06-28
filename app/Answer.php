<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body',
    ];

    public function status(){
        return $this->belongsTo(Question::class);
    }


    public function scopeCorrect($query, $flag){
        return $query->where('correct', $flag);
    }

}
