<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    private $context = "Siswa";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.students.create');
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
            'fullname' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_address' => 'required',
            'parent_phone_number' => 'required|unique:students,parent_phone_number',
            'email' => 'nullable|email|unique:students,email',
            'phone_number' => 'nullable|numeric|unique:students,phone_number'
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number']);
            Student::create($requestData);
            DB::commit();
            return redirect()->route('students.index')->with('success', $this->context . ' berhasil disimpan');
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
        $student = Student::find($id);
        return view('pages.students.edit', compact('student'));
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
            'fullname' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_address' => 'required',
            'parent_phone_number' => 'required|unique:students,parent_phone_number,'.$id,
            'email' => 'nullable|email|unique:students,email,'.$id,
            'phone_number' => 'nullable|numeric|unique:students,phone_number,'.$id
        ]);
        try {
            DB::beginTransaction();
            $student = Student::find($id);
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number']);
            $student->update($requestData);
            DB::commit();
            return redirect()->route('students.index')->with('success', $this->context . ' berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
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
        try{
            DB::beginTransaction();
            $student = Student::find($id);
            $student->delete();
            DB::commit();
            $success = true;      
            return response()->json(['status'=>$success]);
        }catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
