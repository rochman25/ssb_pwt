<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $students = Student::all();
        return view('pages.student_payments.index', compact('payments','students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::user()->id);
        if ($user->hasRole('siswa')) {
            return view('pages.student_payments.create_student');
        }
        $students = Student::all();
        $status = ['pending', 'lunas', 'belum lunas'];
        return view('pages.student_payments.create', compact('students', 'status'));
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
            StudentPayment::create($request->only(['student_id', 'payment_date', 'amount', 'description', 'status']));
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
        $user = User::find($id);
        if ($user->hasRole('siswa')) {
            $payments = StudentPayment::where('student_id', $user->student->id)->get();
            return view('pages.student_payments.index_student', compact('payments'));
        }
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
        $status = ['pending', 'lunas', 'belum lunas'];
        return view('pages.student_payments.edit', compact('payment', 'status', 'students'));
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
            StudentPayment::where('id', $id)->update($request->only(['student_id', 'payment_date', 'amount', 'description', 'status']));
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
        try {
            DB::beginTransaction();
            $payment = StudentPayment::find($id);
            $payment->delete();
            DB::commit();
            $success = true;
            return response()->json(['status' => $success]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'errors' => $e->getMessage()]);
        }
    }

    public function storeStudent(Request $request, $id)
    {
        $request->validate([
            'month' => 'required',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric'
        ]);
        try {
            DB::beginTransaction();
            $student_id = Auth::user()->student->id;
            $requestData = $request->only(['month', 'payment_date', 'amount']);
            $requestData['status'] = 'pending';
            $requestData['student_id'] = $student_id;
            $requestData['description'] = "Pembayaran SPP";
            if ($request->hasfile('payment_proof')) {
                $filename = uniqid() . "." . $request->file("payment_proof")->extension();
                $path = $request->file("payment_proof")->storeAs('public/payments', $filename);
                $url = Storage::url($path);
                $requestData['payment_proof'] = $url;
            }
            StudentPayment::create($requestData);
            DB::commit();
            return redirect()->route('student_payments.show', Auth::user()->id)->with('success', $this->context . ' berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function printPaymentStudent(Request $request, $id)
    {
        try {
            $student = Student::find($id);
            $pdf = PDF::loadView('pages.student_payments.print_out',compact('student'));
            return $pdf->stream();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
