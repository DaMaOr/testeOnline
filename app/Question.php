<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'body',
    ];

    public function status(){
        return $this->belongsTo(Answer::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
