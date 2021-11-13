@extends('layouts.front.master')
@section('content')


    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    <!-- MainContent -->
    <section class="sign-in-page">
        <div class="container">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-lg-5 col-md-12 align-self-center">
                    <div class="sign-user_card ">
                        <div class="sign-in-page-data">
                            <div class="sign-in-from w-100 m-auto">
                                <h3 class="mb-3 text-center">Sign Up</h3>
                                <form class="mt-4" action="index.html">
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter Full Name" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control mb-0" id="exampleInputEmail3" placeholder="Enter email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control mb-0" id="exampleInputPassword2" placeholder="Password" required>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">I accept <a href="#" class="text-primary"> Terms and Conditions</a></label>
                                    </div>

                                    <button type="submit" class="btn btn-hover">Sign Up</button>

                                </form>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-center links">
                                Already have an account? <a href="login.html" class="text-primary ml-2">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MainContent End-->




@endsection
