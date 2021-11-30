<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_user';

    public function user(){
        return $this->belongsTo(Training::class, 'user_id');
    }
    
    public function role(){
        return $this->belongsTo(Regist::class, 'role_id');
    }
}
