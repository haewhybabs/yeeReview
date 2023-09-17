<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','organisation_id','review_date','computed_rating','year','quarter_id','reviewer_rating','national_id','organisation_comment','employee_comment'];

    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
    public function reviewCriteria(){
        return $this->belongsTo(ReviewCriteria::class,'criteria_id','id');
    }
    public function quarter(){
        return $this->belongsTo(Quarter::class,'quarter_id','id');
    }
}
