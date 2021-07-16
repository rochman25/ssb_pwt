<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['fullname', 'gender', 'dob', 'pob', 'address', 'email', 'phone_number', 'parent_name', 'parent_address', 'parent_phone_number'];
}
