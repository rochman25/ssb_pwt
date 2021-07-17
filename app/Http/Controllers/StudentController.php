<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'phone_number' => 'nullable|numeric|unique:students,phone_number',
            'username' => 'required|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username','email']);
            $userData['name'] = $request->input('fullname');
            $userData['password'] = Hash::make($request->input('password'));
            $user = User::create($userData);
            $role = Role::where('name','siswa')->first();
            $user->assignRole([$role->id]);
            $user->markEmailAsVerified();
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number']);
            $requestData['user_id'] = $user->id;
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
        $student = Student::find($id);
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
            'phone_number' => 'nullable|numeric|unique:students,phone_number,'.$id,
            'username' => 'required|alpha_dash|unique:users,username,'.$student->user_id,
            'email' => 'required|email|unique:users,email,'.$student->user_id,
            'password' => 'nullable|confirmed'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username','email']);
            $userData['name'] = $request->input('fullname');
            if(!empty($request->input('password'))){
                $userData['password'] = Hash::make($request->input('password'));   
            }
            User::where('id',$student->user_id)->update($userData);
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
