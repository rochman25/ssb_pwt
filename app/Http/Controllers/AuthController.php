<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

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

    public function authenticate(Request $request)
    {
        $request->validate([
            "username" => "required|string",
            "password" => "required"
        ]);
        try {
            //code...
            $credentials = $request->only('username', 'password');
            $remember = false;
            if ($request->input('remember_me')) {
                $remember = true;
            }
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->route('home.index');
            }

            return back()->withInput()->withError('Mohon maaf username atau password tidak sesuai.');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->withInput()->withError('Mohon maaf terjadi kesalahan pada request anda. Harap mencoba lagi dalam beberapa saat.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        return view('pages.auth.register');
    }

    public function storeNewUser(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $name = $request->input('first_name') . " " . $request->input('last_name');
            $userData = $request->only(['username', 'email']);
            $userData['name'] = $name;
            $userData['password'] = Hash::make($request->input('password'));
            $user = User::create($userData);
            $role = Role::where('name', 'siswa')->first();
            $user->assignRole([$role->id]);
            DB::commit();
            $credentials = $request->only('username', 'password');
            Auth::attempt($credentials);
            $user->sendEmailVerificationNotification();
            return redirect()->route('register.success')->with('success', 'Registrasi Akun Berhasil.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function registerDone(Request $request)
    {
        return view('pages.auth.verification');
    }

    public function verification(EmailVerificationRequest $request)
    {
        $user = User::find($request->route('id')); //takes user ID from verification link. Even if somebody would hijack the URL, signature will be fail the request
        if ($user->hasVerifiedEmail()) {
            $message = __('Email anda sudah diverifikasi.');
            return redirect('login')->with('success', $message);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $message = __('Email anda sudah diverifikasi.');

        return redirect('login')->with('success', $message);
    }

    public function notVerified(Request $request)
    {
        return view('pages.auth.not_verified');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
