<?php

namespace App\Http\Controllers;

use App\Models\ClassInstructor;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    private $context = "Jadwal Latihan";
    public $days = [
        "Sunday" => "Minggu",
        "Monday" => "Senin",
        "Tuesday" => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday" => "Kamis",
        "Friday" => "Jum'at",
        "Saturday" => "Sabtu"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::paginate(10);
        return view('pages.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassInstructor::all();
        $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"];
        return view('pages.schedules.create', compact('classes', 'days'));
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
            'month' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['class_instructor_id', 'week', 'estimate_time','month']);
            $requestData['days'] = implode(",", $request->input('days'));
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
        if ($user->hasRole('siswa')) {
            $schedule = Schedule::find($id);
            $title = "Jadwal Latihan  " . $user->student->fullname;
        } else {
            $schedule = Schedule::find($id);
            $title = "Jadwal Latihan Kelas " . $schedule->class->class->name;
        }
        return view('pages.schedules.show', compact('schedule', 'title'));
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
        $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"];
        return view('pages.schedules.edit', compact('schedule', 'classes', 'days'));
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
            'month' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $requestData = $request->only(['class_instructor_id', 'week', 'estimate_time','month']);
            $requestData['days'] = implode(",", $request->input('days'));
            Schedule::where('id', $id)->update($requestData);
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
        try {
            DB::beginTransaction();
            $schedule = Schedule::find($id);
            $schedule->delete();
            DB::commit();
            $success = true;
            return response()->json(['status' => $success]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'errors' => $e->getMessage()]);
        }
    }

    public function createDetail(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $days = explode(",", $schedule->days);
        return view('pages.schedules.create_detail', compact('schedule', 'days'));
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'day.*' => 'required',
            'activity.*' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $requestData = [];
            foreach ($request->input('days') as $index => $item) {
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
            return redirect()->route('schedules.show', $id)->with('success', 'Kegiatan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function getDetailScheduleJson(Request $request,$id)
    {
        $user = User::find(Auth::user()->id);
        $monthNow = date("Y-m");
        $schedules = [];
        if($user->hasRole(['instructor','Admin'])){
            $schedule = Schedule::with(['details'])->where('month', $monthNow)->where('id',$id)->first();
        }else{
            $student = Student::find(Auth::user()->student->id);
            $schedule = Schedule::with(['details','class' => function($query)use($student){
                $query->where('class_id',$student->class->id);
            }])->where('month', $monthNow)->get();
            // dd($schedule);
        }
        $totalDays = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        if($user->hasRole(['instructor','Admin'])){
            for ($i = 1; $i <= $totalDays; $i++) {
                $date = date("Y") . "-" . date("m") . "-" . $i;
                $day = date('l', strtotime($date));
                $scheduleDays = explode(",", $schedule->days);
                if (in_array($this->days[$day], $scheduleDays)) {
                    foreach ($schedule->details as $index_s => $item_s) {
                        if ($item_s->day == $this->days[$day]) {
                            $schedules[] = [
                                'id' => '1',
                                'calendarId' => '1',
                                'title' => $schedule->class->class->name,
                                'body' => $item_s->activity,
                                'category' => 'time',
                                'dueDateClass' => '',
                                'bgColor' => 'green',
                                'start' => $date,
                                'end' => $date
                            ];
                        }
                    }
                }
            }
        }else{
            for ($i = 1; $i <= $totalDays; $i++) {
                $date = date("Y") . "-" . date("m") . "-" . $i;
                $day = date('l', strtotime($date));
                foreach($schedule as $index_se => $item_se){
                    $scheduleDays = explode(",", $item_se->days);
                    if (in_array($this->days[$day], $scheduleDays)) {
                        // dd($item_se->class);
                        foreach ($item_se->details as $index_s => $item_s) {
                            // dd($item_se->class);
                            if ($item_s->day == $this->days[$day]) {
                                $schedules[] = [
                                    'id' => '1',
                                    'calendarId' => '1',
                                    'title' => $student->class->class->name,
                                    'body' => $item_s->activity,
                                    'category' => 'time',
                                    'dueDateClass' => '',
                                    'bgColor' => 'green',
                                    'start' => $date,
                                    'end' => $date
                                ];
                                // dd($schedules);
                            }
                        }
                    }
                }
            }
        }
        // dd($schedule->toArray());
        // dd($days);
        return response()->json($schedules);
    }
}
