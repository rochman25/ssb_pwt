<?php

namespace App\Http\Controllers;

use App\Models\ClassInstructor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    private $context = "Jadwal Latihan";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::paginate(10);
        return view('pages.schedules.index',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassInstructor::all();
        $days = ["Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu"];
        return view('pages.schedules.create',compact('classes','days'));
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
            'class_instructor_id' => 'required',
            'week' => 'required',
            'days.*' => 'required',
            'estimate_time' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['class_instructor_id','week','estimate_time']);
            $requestData['days'] = implode(",",$request->input('days'));
            Schedule::create($requestData);
            DB::commit();
            return redirect()->route('schedules.index')->with('success', $this->context . ' berhasil disimpan');
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
        $schedule = Schedule::find($id);
        $classes = ClassInstructor::all();
        $days = ["Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu"];
        return view('pages.schedules.edit',compact('schedule','classes','days'));
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
            'class_instructor_id' => 'required',
            'week' => 'required',
            'days.*' => 'required',
            'estimate_time' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['class_instructor_id','week','estimate_time']);
            $requestData['days'] = implode(",",$request->input('days'));
            Schedule::where('id',$id)->update($requestData);
            DB::commit();
            return redirect()->route('schedules.index')->with('success', $this->context . ' berhasil disimpan');
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
            $schedule = Schedule::find($id);
            $schedule->delete();
            DB::commit();
            $success = true;      
            return response()->json(['status'=>$success]);
        }catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
