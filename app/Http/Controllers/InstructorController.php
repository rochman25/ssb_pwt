<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'phone_number' => 'nullable|numeric|unique:instructors,phone_number'
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['name', 'gender', 'email', 'phone_number', 'gender', 'dob', 'pob', 'address']);
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
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'pob' => 'required',
            'address' => 'required',
            'email' => 'nullable|email|unique:instructors,email,'.$id,
            'phone_number' => 'nullable|numeric|unique:instructors,phone_number,'.$id
        ]);
        try {
            DB::beginTransaction();
            $instructor = Instructor::find($id);
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
