<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResultAnswer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function test_result_answers()
    {
        return $this->hasMany('App\TestsResultsAnswer');
    }
}
