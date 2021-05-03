<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            "username" => "required|string",
            "password" => "required"
        ]);
        try {
            //code...
            $credentials = $request->only('username', 'password');
            $remember = false;
            if($request->input('remember_me')){
                $remember = true;
            }
            if (Auth::attempt($credentials,$remember)) {
                $request->session()->regenerate();
                return redirect()->route('home.index');
            }
    
            return back()->withInput()->withError('Mohon maaf username atau password tidak sesuai.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withInput()->withError('Mohon maaf terjadi kesalahan pada request anda. Harap mencoba lagi dalam beberapa saat.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
