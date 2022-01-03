<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function approval(){
        return $this->belongsTo('App\Models\Approval', 'approval_id');
    }

    public function approver(){
        return $this->belongsTo('App\Models\Approver', 'approver_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
