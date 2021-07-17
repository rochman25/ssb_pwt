<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassInstructor;
use App\Models\ClassStudent;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    private $context = "Kelas";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::paginate(10);
        return view('pages.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructors = Instructor::all();
        $students = Student::all();
        return view('pages.classes.create', compact('instructors', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'is_active' => 'required',
            'description' => 'required',
            'instructor_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $is_active = $request->input('is_active') == '0' ? true : false;
            $requestData = $request->only(['name', 'description']);
            $requestData['is_active'] = $is_active;
            $class = Classes::create($requestData);

            //class instructor
            $requestDataCInstructor = $request->only(['instructor_id']);
            $requestDataCInstructor['class_id'] = $class->id;
            ClassInstructor::create($requestDataCInstructor);

            //class students
            $students = $request->input('students');
            $requestDataCStudents = [];
            foreach ($students as $index => $item) {
                $requestDataCStudents[] = [
                    'student_id' => $item,
                    'class_id' => $class->id,
                    'created_at' => date('y-m-d H:i:s'),
                    'updated_at' => date('y-m-d H:i:s')
                ];
            }
            ClassStudent::insert($requestDataCStudents);

            DB::commit();
            return redirect()->route('classes.index')->with('success', $this->context . ' berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classes::find($id);
        $instructors = Instructor::all();
        $students = Student::all();
        return view('pages.classes.edit', compact('class', 'instructors', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'is_active' => 'required',
            'description' => 'required',
            'instructor_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $class = Classes::find($id);
            $is_active = $request->input('is_active') == '1' ? true : false;
            $requestData = $request->only(['name', 'description']);
            $requestData['is_active'] = $is_active;
            $class->update($requestData);

            //class instructor
            $requestDataCInstructor = $request->only(['instructor_id']);
            ClassInstructor::where('class_id', $class->id)->update($requestDataCInstructor);

            //class students
            $students = $request->input('students');
            $requestDataCStudents = [];
            $classStudents = array_column($class->students->toArray(),'student_id');
            $missingStudents = array_diff($classStudents,$students);
            // dd($missingStudents);

            //add new student
            foreach ($students as $index => $item) {
                if(!in_array($item, $classStudents) && !in_array($item,$missingStudents)){
                    $requestDataCStudents = [
                        'student_id' => $item,
                        'class_id' => $id,
                        'created_at' => date('y-m-d H:i:s'),
                        'updated_at' => date('y-m-d H:i:s')
                    ];
                    ClassStudent::create($requestDataCStudents);
                }
            }

            //remove student
            if(!empty($missingStudents)){
                foreach($missingStudents as $index => $item){
                    ClassStudent::where('class_id',$id)->where('student_id',$item)->delete();
                }
            }
            DB::commit();
            return redirect()->route('classes.index')->with('success', $this->context . ' berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $student = Classes::find($id);
            $student->delete();
            DB::commit();
            $success = true;
            return response()->json(['status' => $success]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'errors' => $e->getMessage()]);
        }
    }
}
