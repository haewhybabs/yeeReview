<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','organisation_id','review_date','rating','organisation_comment','employee_comment','criteria_id'];

    public function organisation(){
        $this->belongsTo(Organisation::class,'organisation_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function reviewCriteria(){
        return $this->belongsTo(ReviewCriteria::class,'criteria_id','id');
    }
}
