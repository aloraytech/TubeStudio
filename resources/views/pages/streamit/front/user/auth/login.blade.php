@extends('layouts.streamit.front.master')
@section('content')



    <!-- loader Start -->
   <div id="loading">
       <div id="loading-center">
       </div>
    </div>
    <!-- loader END -->
    <!-- MainContent -->
    <section class="sign-in-page">
        <div class="container">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-lg-5 col-md-12 align-self-center">
                    <div class="sign-user_card ">
                        <div class="sign-in-page-data">
                            <div class="sign-in-from w-100 m-auto">
                                <h3 class="mb-3 text-center">Sign in</h3>
                                <form class="mt-4" action="{{ route('login.user') }}" method="post" > @CSRF
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword2" placeholder="Password" required>
                                    </div>

                                    <div class="sign-info">
                                        <button type="submit" class="btn btn-hover">Sign in</button>
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-center links">
                                Don't have an account? <a href="{{ route('register.user') }}" class="text-primary ml-2">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                <a href="reset-password.html" class="f-link">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MainContent End-->




@endsection
