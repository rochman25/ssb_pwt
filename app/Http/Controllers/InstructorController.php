<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InstructorController extends Controller
{
    private $context = "Pelatih";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::paginate(10);
        return view('pages.instructors.index',compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.instructors.create');
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
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'email' => 'nullable|email|unique:instructors,email',
            'phone_number' => 'nullable|numeric|unique:instructors,phone_number',
            'username' => 'required|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username','email','name']);
            $userData['password'] = Hash::make($request->input('password'));
            $user = User::create($userData);
            $role = Role::where('name','instructor')->first();
            $user->assignRole([$role->id]);
            $user->markEmailAsVerified();
            $requestData = $request->only(['name', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address']);
            $requestData['user_id'] = $user->id;
            Instructor::create($requestData);
            DB::commit();
            return redirect()->route('instructors.index')->with('success', $this->context . ' berhasil disimpan');
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
        $instructor = Instructor::find($id);
        return view('pages.instructors.show',compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::find($id);
        return view('pages.instructors.edit',compact('instructor'));
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
        $instructor = Instructor::find($id);
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'email' => 'nullable|email|unique:instructors,email,'.$id,
            'phone_number' => 'nullable|numeric|unique:instructors,phone_number,'.$id,
            'username' => 'required|alpha_dash|unique:users,username,'.$instructor->user_id,
            'email' => 'required|email|unique:users,email,'.$instructor->user_id,
            'password' => 'nullable|confirmed'
        ]);
        try {
            DB::beginTransaction();
            $userData = $request->only(['username','email','name']);
            if(!empty($request->input('password'))){
                $userData['password'] = Hash::make($request->input('password'));   
            }
            User::where('id',$instructor->user_id)->update($userData);
            $requestData = $request->only(['name', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address']);
            $instructor->update($requestData);
            DB::commit();
            return redirect()->route('instructors.index')->with('success', $this->context . ' berhasil disimpan');
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
            $instructor = Instructor::find($id);
            $instructor->delete();
            DB::commit();
            $success = true;      
            return response()->json(['status'=>$success]);
        }catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
