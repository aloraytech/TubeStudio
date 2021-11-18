@extends('layouts.webtube.front.master')
@section('content')

    <div class="container">
        <div class="card mt-5 mb-5">
            <div class="card-header bg-danger text-white">
                <div class="card-title text-center display-1">
                    Opps! Under Construction
                </div>
            </div>
            <div class="card-body text-center display-3 mt-5 mb-5">
                <p id="timer_area" style="font-size:30px"></p>
            </div>
            <div class="card-footer text-center bg-danger text-white">
                <p><b>{{env('APP_URL')}}</b> <br> Currently Upgrading And Bug Fixing For Give You Awesome Experience.</p>
            </div>
        </div>
    </div>

    <script>

        // Set the date we're counting down to
        var countDownDate = new Date("{{$system->coming_soon_upto}}").getTime();

        // Update the count down every 1 second
        var countdownfunction = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer_area").innerHTML = "We Back in " + days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(countdownfunction);
                document.getElementById("timer_area").innerHTML = "Restarting Services";
            }
        }, 1000);
    </script>




@endsection
