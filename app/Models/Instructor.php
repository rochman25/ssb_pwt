<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'gender', 'dob', 'pob', 'address', 'email', 'phone_number','user_id','photo_profil'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->hasOne(ClassInstructor::class,'instructor_id');
    }

}
