<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(Request $request){
        $user = User::find(Auth::user()->id);
        if($user->hasrole('siswa')){
            if(!Auth::user()->student){
                $status = ["acc" => "Diterima","fail" => "Gagal", "pending" => "Sedang Diproses"];
                return view('pages.students.create-student',compact('status'));
            }
            $student = Student::find(Auth::user()->student->id);
            // dd($student->class);
            $jadwal = [];
            if($student->class){
                $jadwal = Schedule::with(['details','class'])->whereHas('class',function($query)use($student){
                    $query->where('class_id',$student->class->class_id);
                })->orderBy('created_at','ASC')->get();
            }
            // dd($jadwal->toArray());
            return view('pages.dashboard.siswa',compact('jadwal'));
        }else if($user->hasrole('instructor')){
            $instructor = Instructor::find(Auth::user()->instructor->id);
            $jadwal = [];
            if($instructor->class){
                $jadwal = Schedule::with(['details','class'])->whereHas('class',function($query)use($instructor){
                    $query->where('class_id',$instructor->class->class_id);
                })
                // ->where('class_instructor_id',$instructor->class->id)
                ->orderBy('created_at','ASC')->get();
            }
            // dd($jadwal->toArray());
            return view('pages.dashboard.instructor',compact('jadwal'));
        }
        $totalSiswa = Student::count();
        $totalPelatih = Instructor::count();
        $totalUser = User::count();
        $totalKelas = Classes::count();
        return view('pages.dashboard.admin',compact('totalSiswa','totalPelatih','totalUser','totalKelas'));
    }

}
