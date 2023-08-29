<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','organisation_id','decision_status','hiring_manager_id'];

    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function hiringManager(){
        return $this->belongsTo(HiringManager::class,'hiring_manager_id','id');
    }
}
