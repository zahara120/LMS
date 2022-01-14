<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function approval(){
        return $this->belongsTo(Approval::class, 'approval_id');
    }

    public function posttest()
    {
        return $this->belongsTo(Test::class);
    }

    public function pretest()
    {
        return $this->belongsTo(Test::class);
    }

    // coba dulu 
    public function posttest_result()
    {
        return $this->belongsTo(Test::class, 'posttest_id');
    }

    public function pretest_result()
    {
        return $this->belongsTo(Test::class, 'pretest_id');
    }
    
    public function lesson(){
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function regist()
    {
        return $this->hasMany(Regist::class);
    }
    
    public function registTraining(){
        return $this->hasMany(RegistTraining::class);
    }
}