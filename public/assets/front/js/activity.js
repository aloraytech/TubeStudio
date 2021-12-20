
// update category status

// $(".update-video-like-status").click(function(){
//     var status = $(this).text();
//     var category_id = $(this).attr("category_id");
//     // alert(category_id);
//     $.ajax({

//         type:'post',
//         url:'/admin/update-category-status',
//         data:{status:status,category_id:category_id},
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },

//         success:function(resp){
//             // alert(resp['status']);
//             // alert(resp['category_id']);
//             if(resp['status'] === 0){
//                 $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>")
//             }else if(resp['status'] === 1){
//                 $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>")
//             }else if(resp['status'] === 2){
//                 $("#myModal").modal("show");
//             }

//         },error:function(){
//             alert("Error");
//         }

//     });
// });



// update video Like status
$(".addLikeToVideo").click(function(){
    // var status = $(this).attr("status");
    var video_id = $(this).attr("video_id");

    // alert(video_id);
    // alert('good');

    $.ajax({

        type:'post',
        url:'/update-video-like-status',
        data:{video_id:video_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(resp){
            // alert(resp['status']);
            // alert(resp['video_id']);
            if(resp['status'] === 0){
                $("#like-"+video_id).html("<a class='addLikeToVideo' href='javascript:void(0)'><span class='ml-1'><i class='fa fa-thumbs-o-up'></i></span></a>")
            }else if(resp['status'] === 1){
                $("#like-"+video_id).html("<a class='addLikeToVideo' href='javascript:void(0)'><span class='ml-1'><i class='fa fa-thumbs-up'></i></span></a>")
            }else if(resp['status'] === 2){
                $("#myModal").modal("show");
            }

        },error:function(){
            alert("Error");
        }

    });
});




// // update video Favorite status
$(".addFavoriteToVideo").click(function(){
    // var status = $(this).text();
    var video_id = $(this).attr("video_id");
    // alert(video_id);
    $.ajax({

        type:'post',
        url:'/update-video-favourite-status',
        data:{video_id:video_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(resp){
            //    alert(resp['status']);
            // alert(resp['video_id']);
            if(resp['status'] === 0){
                $("#favorite-"+video_id).html("<a class='addFavoriteToVideo' href='javascript:void(0)'><span  class='ml-1'><i class='ri-heart-line'></i></span></a>")
            }else if(resp['status'] === 1){
                $("#favorite-"+video_id).html("<a class='addFavoriteToVideo' href='javascript:void(0)'><span  class='ml-1'><i class='ri-heart-fill'></i></span></a>")
            }else if(resp['status'] === 2){
                $("#myModal").modal("show");
            }

        },error:function(){
            alert("Error");
        }

    });
});

// update video Watchlist status
$(".addWatchlistToVideo").click(function(){
    var video_id = $(this).attr("video_id");
    //alert(video_id);
    $.ajax({

        type:'post',
        url:'/update-video-watchlist-status',
        data:{video_id:video_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(resp){
            //alert(resp['status']);
            //alert(resp['video_id']);
            if(resp['status'] === 0){
                $("#watchlist-"+video_id).html("<a class='addWatchlistToVideo' href='javascript:void(0)'><span class='ml-1'><i class='fa fa-star-half'></i></span></a>")
            }else if(resp['status'] === 1){
                $("#watchlist-"+video_id).html("<a class='addWatchlistToVideo' href='javascript:void(0)'><span class='ml-1'><i class='fa fa-star'></i></span></a>")
            }else if(resp['status'] === 2){
                $("#myModal").modal("show");
            }

        },error:function(){
            alert("Error");
        }

    });
});



// AUTO INTERACTION FOR VIDEO
$(".touchVideo").mouseenter(function(){

    var video_id = $(this).attr("video_id");
    //  alert(video_id);
    $.ajax({

        type:'post',
        url:'/make-interaction-with-video',
        data:{video_id:video_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(resp){
            if(resp['status'] === 0){
            }else if(resp['status'] === 1){
                window.location.reload();
            }else if(resp['status'] === 2){
                $("#myModal").modal("show");
            }
        },error:function(){
            alert("Error");
        }

    });
});





//Charts

