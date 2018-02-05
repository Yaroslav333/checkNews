$(document).ready(function () {
   $('#card-title-input').on('change keyup input', function () {
       $('#card-title').text($(this).val());
   });

    $('#card-body-input').on('change keyup input', function () {
        $('#card-body').text($(this).val());

        if ($(this).val() == "" || $(this).val() == null) {
            $('.rightimg').css('width', '100%');
        } else {
           // $('.rightimg').css('width', '40%');
        }

    });

    $('#card-source-input').on('change keyup input', function () {

        if ($('#card-source-input').val() != '' && $('#card-source-input').val() != null) {
            $('#card-source').attr('href', 'http://' + $(this).val());
            $('#card-source').text( $(this).val());
        } else {
            $('#card-source').attr('href', '');
            $('#card-source').text( '' );
        }

        //

    });

    $("#card-img-input").on('change', function () {
        readURL(this);
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#card-img')
                    .attr('src', e.target.result);
                $('#card-img').show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#remove-img-btn').on('click', function () {
        $('#card-img-input').val(null);
        $('#card-img')
            .attr('src', '');
        $('#card-img').hide();
        $('.file-path').val('');
    });


    $('#delete-img-btn').on('click', function () {

        if ($('.file-path').val() != '' && $('.file-path').val() != null) {
            $('#delete-img-progress').show();
            $.ajax({
                type: "GET",
                url: "/admin/news/delete-img/" + $('#news_id').val(),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    $('#card-img-input').val(null);
                    $('#card-img')
                        .attr('src', '');
                    $('#card-img').hide();
                    $('.file-path').val('');

                    $('#delete-img-progress').hide();
                },
            });
        }
    });



    $('#store-news-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/admin/news",
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                window.location = "/admin/news/" + data.id;
            },


        });


         return false;
    });

    $('#update-news-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/admin/news/" + $('#news_id').val(),
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
               window.location = "/admin/news/" + data.id;
            },
        });
        return false;
    });


    $('.modal').modal();

    $('#delete-news-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/admin/news/delete/" + $('#news_id').val(),
            data:  new FormData(this),
            processData: false,
            contentType: false,
            success: function(){
                window.location = "/admin/news/";

            },
        });
        return false;
    });


    //Greetings card
    $('#greetings-body-input').on('change keyup input', function () {
        $('#greetings-body').text($(this).val());
    });

    $('#greetings-title-input').on('change keyup input', function () {
        $('#greetings-title').text($(this).val());
    });

    $('#greetings-btn-input').on('change keyup input', function () {
        if ($('#greetings-btn-input').val() != '' && $('#greetings-btn-input').val() != null) {
            $('#greetings-btn').show();
        } else {
            $('#greetings-btn').hide();
        }
        $('#greetings-btn').text($(this).val());
    });

    $( ".game_card_content_box" ).mousedown(function () {

    });

    //bind to determined event(s)
    $(".game_card_content_box").bind('mousedown touchstart', function(event) {

        //console.log(11);


    });


    var lastY;

    $(document).on('touchmove', '.game_card_content_box', function(e) {
        var scroll = $( ".game_card_content_box" ).scrollTop();
        var yPos = e.originalEvent.touches[0].pageY;
        //console.log( e.originalEvent.changedTouches[0]);
       // console.log($( ".game_card_content_box" ).scrollTop());
        var scroll_possition = $( ".game_card_content_box" ).scrollTop();

        var currentY = e.originalEvent.touches[0].clientY;
        if(currentY > lastY){
            //move down
            $( ".game_card_content_box" ).scrollTop( scroll - 13 );
        }else if(currentY < lastY){
            // moved up
            $( ".game_card_content_box" ).scrollTop( scroll + 13 );
        }
        lastY = currentY;

       // $( ".game_card_content_box" ).scrollTop( yPos );
    });

    $('#store-user-form').submit(function (e) {
        if ($('#user_password').val() !== $('#user_confirm_password').val()) {
            Materialize.toast('Поддтвержденный пароль не верный.', 4000);
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "/admin/users",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    if (data.error !== undefined) {
                        Materialize.toast(data.error, 4000);
                    } else {
                        window.location = "/admin/users";
                    }
                },


            });
        }
        return false;
    });

    $('#store-result-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/admin/result",
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                window.location = "/admin/news/";
            },
        });
        return false;
    });

    if (document.URL.split('/').length >= 4 && document.URL.split('/')[4] == 'result') {
         var editor = CKEDITOR.replace( 'final_info' );
         // The "change" event is fired whenever a change is made in the editor.
         editor.on( 'change', function( evt ) {
             // getData() returns CKEditor's HTML content.
             console.log(evt.editor.getData());
             $('#final_info').val(evt.editor.getData());
         });
    }


});
(function($){
    $(function(){

        $('.button-collapse').sideNav();

    }); // end of document ready
})(jQuery); // end of jQuery name space