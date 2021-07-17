<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassInstructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'instructor_id',
    ];

    public function instructor(){
        return $this->belongsTo(Instructor::class,'instructor_id');
    }

    public function class(){
        return $this->belongsTo(Classes::class,'class_id');
    }

}
