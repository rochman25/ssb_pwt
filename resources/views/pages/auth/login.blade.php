@extends('layouts.app_empty')
@section('title', 'Login-one')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/other-images/auth-bg-1.jpg')}}" alt="looginpage"></div>
      <div class="col-xl-5 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo text-left" href="{{ route('index') }}"><img class="img-fluid for-light" src="{{asset('assets/images/other-images/logo-login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form">
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" required="" placeholder="Test@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                        <div class="show-hide"><span class="show">                         </span></div>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                     </div>
                     {{-- <p class="mt-4 mb-0">Don't have account?<a class="ml-2" href="{{ route('sign-up') }}">Create Account</a></p> --}}
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection