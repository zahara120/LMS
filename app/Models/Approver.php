<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approversatu()
    {
        return $this->belongsTo(User::class,'approversatu_id');
    }

    public function approverdua()
    {
        return $this->belongsTo(User::class,'approverdua_id');
    }

    public function approvertiga()
    {
        return $this->belongsTo(User::class,'approvertiga_id');
    }

    public function approval_detail(){
        return $this->hasMany('App\Models\ApprovalDetail');
    }
}
