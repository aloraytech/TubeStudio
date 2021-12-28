/*
Applicable For: User Interactivity Handle
Author: aloraytech.in
Design and Developed by: aloraytech.in
NOTE: This file contains the functionality for Aloraytech/Webtube Project.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------
:: likeIt
:: addOrRemoveFromList
:: favourite
:: Sidebar Widget
:: Page FAQ
:: Page Loader
:: Owl Carousel
:: Search input
:: Scrollbar
:: Counter
:: slick
 */

$(document).ready(function(){
    // $('.block-social-info span').click(function(e){
    //     e.preventDefault();
    //     console.log("this is the click");
    //     alert('This is click');
    // });

    // Google Ads
    $(".adsbygoogle").each(function () { (adsbygoogle = window.adsbygoogle || []).push({}); });




    // Click Functions


    $(".like_activity").click(function(){

        let content_type = $(this).attr("content_type");
        let content_id = $(this).attr("content_id");
        alert(content_type);
        alert(content_id);

    });




    $("#watchlist_activity").click(function(){

        alert('Click On Add And Remove Found');

    });




    $("#favourite_activity").click(function(){

        alert('Click On Favourite Found');

    });


    $("#rating_activity").click(function(){

        alert('Click On Rating Found');

    });


    $("#load_detail").click(function(){

        alert('Click On Favourite Found');

    });


    $("#view_activity").click(function(){

        alert('Click On Favourite Found');

    });




    // Get Season Details
    $('#seasonSelector').on('change', function() {
        // window.location.href = '/path';
        // window.location.assign("/path");

        // alert( this.value );
        // alert( this.name );


        //let url = show.concat("/").concat(season);
        window.location.href = '/'.concat(this.name).concat("/").concat(this.value);

    });




});
