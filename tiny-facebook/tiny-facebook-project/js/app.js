$(document).ready(function () {

    //On pressing a key on "Search box" in "search.php" file. This function will be called.

    $("#search").keyup(function () {

        //Assigning search box value to javascript variable named as "name".

        var name = $('#search').val();

        //Validating, if "name" is empty.

        if (name == "") {

            //Assigning empty value to "display" div in "search.php" file.

            $("#display").html("");

        }

        //If name is not empty.
        else {

            //AJAX is called.

            $.ajax({

                //AJAX type is "Post".

                type: "POST",

                //Data will be sent to "ajax.php".
                //Ajax sur Wamp url: "/tinyfacebook/tiny-facebook/tiny-facebook-project/traitement/searchfriend.php",
                //Ajax sur C9.io
                url: "/tiny-facebook/tiny-facebook-project/traitement/searchfriend.php",

                //Data, that will be sent to "ajax.php".

                data: {

                    //Assigning value of "name" into "search" variable.

                    search: name

                },

                //If result found, this funtion will be called.

                success: function (html) {

                    //Assigning result to "display" div in "search.php" file.
                    $("#display").html(html).show();

                }

            });

        }

    });

});


// AJAX PART LIKE DISLIKE


$(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('glyphicon glyphicon-thumbs-up')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('glyphicon glyphicon-thumbs-up liked')){
  	action = 'unlike';
  }
  $.ajax({
  	url: 'index.php?action=monmur',
  	type: 'post',
  	dataType : "json",
  //  contentType: "application/json; charset=utf-8",
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){

  		res = JSON.parse(data);
  		console.log(data);
  		if (action == "like") {
  			$clicked_btn.removeClass('glyphicon glyphicon-thumbs-up');
  			$clicked_btn.addClass('glyphicon glyphicon-thumbs-up liked');
  		} else if(action == "unlike") {
  			$clicked_btn.removeClass('glyphicon glyphicon-thumbs-up liked');
  			$clicked_btn.addClass('glyphicon glyphicon-thumbs-up');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);

  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.glyphicon glyphicon-thumbs-up').removeClass('glyphicon glyphicon-thumbs-up').addClass('glyphicon glyphicon-thumbs-up liked');
  	}
  });		

});

// if the user clicks on the dislike button ...
$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('glyphicon glyphicon-thumbs-down')) {
  	action = 'dislike';
  } else if($clicked_btn.hasClass('glyphicon glyphicon-thumbs-down disliked')){
  	action = 'undislike';
  }
  $.ajax({
  	url: 'index.php?action=monmur',
  	type: 'post',
  	dataType : "json",
    contentType: "application/json; charset=utf-8",
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "dislike") {
  			$clicked_btn.removeClass('glyphicon glyphicon-thumbs-down');
  			$clicked_btn.addClass('glyphicon glyphicon-thumbs-down disliked');
  		} else if(action == "undislike") {
  			$clicked_btn.removeClass('glyphicon glyphicon-thumbs-down disliked');
  			$clicked_btn.addClass('glyphicon glyphicon-thumbs-down');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
  		
  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.glyphicon glyphicon-thumbs-down').removeClass('glyphicon glyphicon-thumbs-down').addClass('glyphicon glyphicon-thumbs-down disliked');
  	}
  });	

});

});

