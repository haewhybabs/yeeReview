<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $fillable = ['national_id','organisation_id','decision_status','hiring_manager_id','candidate_name'];

    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id','id');
    }

    public function employments(){
        return $this->hasMany(Organisation::class,'national_id','national_id');
    }
    public function hiringManager(){
        return $this->belongsTo(HiringManager::class,'hiring_manager_id','id');
    }
}
