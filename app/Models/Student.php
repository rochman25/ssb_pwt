<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'gender',
        'dob',
        'pob',
        'address',
        'email',
        'phone_number',
        'parent_name',
        'parent_address',
        'parent_phone_number',
        'user_id',
        'status',
        'register_date',
        'photo_profil'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->hasOne(ClassStudent::class,'student_id');
    }

    public function payments(){
        return $this->hasMany(StudentPayment::class,'student_id');
    }

}
