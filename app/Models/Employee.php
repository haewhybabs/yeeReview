<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','current_organisation_id','bio','address','dob','phone_number','marital_status','national_id','position','department_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function organisation(){
        return $this->belongsTo(Organisation::class,'current_organisation_id','id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
