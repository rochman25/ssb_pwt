<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['class_instructor_id','week','estimate_time','days','month'];

    public function class(){
        return $this->belongsTo(ClassInstructor::class,'class_instructor_id');
    }

    public function details(){
        return $this->hasMany(ScheduleDetail::class,'schedule_id');
    }

}
