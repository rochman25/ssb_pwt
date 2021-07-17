<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPaymentController extends Controller
{
    private $context = "Pembayaran Siswa";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = StudentPayment::paginate(10);
        return view('pages.student_payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $status = ['pending','lunas','belum lunas'];
        return view('pages.student_payments.create',compact('students','status'));
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
            'student_id' => 'required',
            'payment_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        try {
            DB::beginTransaction();
            StudentPayment::create($request->only(['student_id','payment_date','amount','description','status']));
            DB::commit();
            return redirect()->route('student_payments.index')->with('success', $this->context . ' berhasil disimpan');
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
        $payment = StudentPayment::find($id);
        $students = Student::all();
        $status = ['pending','lunas','belum lunas'];
        return view('pages.student_payments.edit',compact('payment','status','students'));
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
            'student_id' => 'required',
            'payment_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        try {
            DB::beginTransaction();
            StudentPayment::where('id',$id)->update($request->only(['student_id','payment_date','amount','description','status']));
            DB::commit();
            return redirect()->route('student_payments.index')->with('success', $this->context . ' berhasil disimpan');
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
            $payment = StudentPayment::find($id);
            $payment->delete();
            DB::commit();
            $success = true;      
            return response()->json(['status'=>$success]);
        }catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
