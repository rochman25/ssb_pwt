<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use PDF;

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
        $status = ["acc" => "Diterima", "fail" => "Gagal", "pending" => "Sedang Diproses"];
        return view('pages.students.create', compact('status'));
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
            'password' => 'required|confirmed',
            'register_date' => 'required|date',
            'status' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username', 'email']);
            $userData['name'] = $request->input('fullname');
            $userData['password'] = Hash::make($request->input('password'));
            $user = User::create($userData);
            $role = Role::where('name', 'siswa')->first();
            $user->assignRole([$role->id]);
            $user->markEmailAsVerified();
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number', 'register_date', 'status']);
            $requestData['user_id'] = $user->id;
            if ($request->hasfile('photo_profil')) {
                $filename = uniqid() . "." . $request->file("photo_profil")->extension();
                $path = $request->file("photo_profil")->storeAs('public/students', $filename);
                $url = Storage::url($path);
                $requestData['photo_profil'] = $url;
            }
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
        $student = Student::find($id);
        return view('pages.students.show', compact('student'));
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
        $status = ["acc" => "Diterima", "fail" => "Gagal", "pending" => "Sedang Diproses"];
        return view('pages.students.edit', compact('student', 'status'));
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
            'parent_phone_number' => 'required|unique:students,parent_phone_number,' . $id,
            'email' => 'nullable|email|unique:students,email,' . $id,
            'phone_number' => 'nullable|numeric|unique:students,phone_number,' . $id,
            'username' => 'required|alpha_dash|unique:users,username,' . $student->user_id,
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'password' => 'nullable|confirmed',
            'register_date' => 'required|date',
            'status' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username', 'email']);
            $userData['name'] = $request->input('fullname');
            if (!empty($request->input('password'))) {
                $userData['password'] = Hash::make($request->input('password'));
            }
            User::where('id', $student->user_id)->update($userData);
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number', 'register_date', 'status']);
            if ($request->hasfile('photo_profil')) {
                $file = explode("/", $student->photo_profil);
                Storage::delete('public/students/' . $file[array_key_last($file)]);

                $filename = uniqid() . "." . $request->file("photo_profil")->extension();
                $path = $request->file("photo_profil")->storeAs('public/students', $filename);
                $url = Storage::url($path);
                $requestData['photo_profil'] = $url;
            }
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
        try {
            DB::beginTransaction();
            $student = Student::find($id);
            $file = explode("/", $student->photo_profil);
            Storage::delete('public/students/' . $file[array_key_last($file)]);
            $student->delete();
            DB::commit();
            $success = true;
            return response()->json(['status' => $success]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'errors' => $e->getMessage()]);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'parent_address' => 'required',
            'parent_phone_number' => 'required|unique:students,parent_phone_number,' . $id,
            'phone_number' => 'nullable|numeric|unique:students,phone_number,' . $id,
        ]);
        try {
            DB::beginTransaction();
            $student = Student::find($id);
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number']);
            if ($request->hasfile('photo_profil')) {
                $file = explode("/", $student->photo_profil);
                Storage::delete('public/students/' . $file[array_key_last($file)]);

                $filename = uniqid() . "." . $request->file("photo_profil")->extension();
                $path = $request->file("photo_profil")->storeAs('public/students', $filename);
                $url = Storage::url($path);
                $requestData['photo_profil'] = $url;
            }
            $student->update($requestData);
            DB::commit();
            return redirect()->back()->with('success', 'Biodata berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function printStudents(Request $request)
    {
        try {
            $students = Student::all();
            $pdf = PDF::loadView('pages.students.print_out', compact('students'));
            return $pdf->stream();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function registerStudent(Request $request)
    {
        try {
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
            ]);
            DB::beginTransaction();
            $requestData = $request->only(['fullname', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address', 'parent_name', 'parent_address', 'parent_phone_number']);
            $requestData['user_id'] = Auth::user()->id;
            $requestData['register_date'] = date("Y-m-d");
            $requestData['status'] = 'pending';
            if ($request->hasfile('photo_profil')) {
                $filename = uniqid() . "." . $request->file("photo_profil")->extension();
                $path = $request->file("photo_profil")->storeAs('public/students', $filename);
                $url = Storage::url($path);
                $requestData['photo_profil'] = $url;
            }
            Student::create($requestData);
            DB::commit();
            return redirect()->route('students.register.success')->withInput()->with('success', 'Pendaftaran anda berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function successRegister(Request $request){
        // dd(Auth::user()->student);
        if(Auth::user()->student->status != "acc"){
            return view('pages.students.success_registration');   
        }
        return redirect()->route('home.index');
    }

}
