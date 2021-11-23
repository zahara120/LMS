<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function approval(){
        return $this->belongsTo('App\Models\Approval', 'approval_id');
    }
    
    public function lesson(){
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }

    public function room(){
        return $this->hasOne('App\Models\Room', 'room_id');
    }

    public function venue(){
        return $this->hasOne('App\Models\Venue', 'venue_id');
    }
}