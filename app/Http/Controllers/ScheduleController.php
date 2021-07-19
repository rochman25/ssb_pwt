<?php

namespace App\Http\Controllers;

use App\Models\ClassInstructor;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find(Auth::user()->id);
        if($user->hasRole('siswa')){
            $schedule = Schedule::find($id);
            $title = "Jadwal Latihan  ".$user->student->fullname;
        }else{
            $schedule = Schedule::find($id);
            $title = "Jadwal Latihan Kelas ".$schedule->class->class->name;
        }
        return view('pages.schedules.show',compact('schedule','title'));
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

    public function createDetail(Request $request,$id){
        $schedule = Schedule::find($id);
        $days = explode(",",$schedule->days);
        return view('pages.schedules.create_detail',compact('schedule','days'));
    }

    public function storeDetail(Request $request, $id){
        $request->validate([
            'day.*' => 'required',
            'activity.*' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $requestData = [];
            foreach($request->input('days') as $index => $item){
                $requestData[] = [
                    'day' => $item,
                    'activity' => $request->input('activity')[$index],
                    'schedule_id' => $id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
            }
            ScheduleDetail::insert($requestData);
            DB::commit();
            return redirect()->route('schedules.show',$id)->with('success','Kegiatan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function getDetailScheduleJson(Request $request){
        $monthNow = date("Y-m");
        $schedule = Schedule::with(['details'])->where('month',$monthNow)->get();
        // dd($schedule->toArray());
        $json = [[
            'id' => '1',
            'calendarId' => '1',
            'title' => 'my schedule',
            'category' => 'time',
            'dueDateClass' => '',
            'start' => '2021-07-18T22:30:00+09:00',
            'end' => '2021-07-20T02:30:00+09:00'
        ],
        [
            'id' => '2',
            'calendarId' => '1',
            'title' => 'my second schedule',
            'category' => 'time',
            'dueDateClass' => '',
            'start' => '2021-07-16T22:30:00+09:00',
            'end' => '2021-07-21T02:30:00+09:00'
        ]
        ];
        return response()->json($json);
    }

}
