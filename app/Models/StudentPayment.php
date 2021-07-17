<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    protected $table = "student_paymetns";
    protected $fillable = ['student_id','payment_date','amount','status','description'];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

}
