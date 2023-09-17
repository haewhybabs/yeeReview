<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','organisation_id','description','status','quarter_id','expected_days','delivered_days','completed_on_time','goal_name','year','weight'];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id','id');
    }

    public function quarter(){
        return $this->belongsTo(Quarter::class,'quarter_id','id');
    }
}
