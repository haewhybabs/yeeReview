<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','address','phone_number','industry','website','user_id','email','status'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function employee(){
        return $this->hasOne(Employee::class,'current_organisation_id','id');
    }
    public function performanceReview(){
        return $this->hasMany(PerformanceReview::class,'organisation_id','id');
    }
    public function goal(){
        return $this->hasMany(Goal::class,'organisation_id','id');
    }
    public function feedback(){
        return $this->hasMany(Feedback::class,'organisation_id','id');
    }
    public function recruitment(){
        return $this->hasMany(Recruitment::class,'organisation_id','id');
    }
    public function hiringManager(){
        return $this->hasMany(HiringManager::class,'organisation_id','id');
    }

}
