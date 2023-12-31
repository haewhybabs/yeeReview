<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','organisation_id','organisation_comment','employee_comment','review_id'];
    
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id','id');
    }

    public function performanceReview(){
        return $this->belongsTo(PerformanceReview::class,'review_id','id');
    }
}
