<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCriteria extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    public function performanceReview(){
        return $this->hasMany(performanceReview::class,'criteria_id','id');
    }
}
