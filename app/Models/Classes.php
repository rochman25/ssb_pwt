<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = "classes";
    protected $fillable = ['name','description','is_active'];

    public function detail(){
        return $this->hasOne(ClassInstructor::class,'class_id','id');
    }

    public function students(){
        return $this->hasMany(ClassStudent::class,'class_id');
    }

}   
