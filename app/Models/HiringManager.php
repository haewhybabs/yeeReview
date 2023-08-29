<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiringManager extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','organisation_id','description','department','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recruitment(){
        return $this->hasMany(Recruitment::class,'hiring_manager_id','id');
    }

}
