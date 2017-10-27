/**
 * Created by Владимир on 26.10.2017.
 */
$(document).ready(function(){
    $('#comment_form').on('submit', function(e){
        e.preventDefault();
        var error = $('#comment_error');
        var message = $('#comment_message');
        $.ajax({
            type: 'POST',
            url: '/ajaxComment',
            data: $('#comment_form').serialize(),
            success: function(data){
                if(data.result)
                {
                    error.hide();
                    message.show();
                }
                else
                {
                    error.show();
                    message.hide();
                }
            },
            error: function(data){
                if ( 'responseJSON' in data ) {
                    if ('comment' in data.responseJSON ) {
                        error.html('<strong>' + data.responseJSON.comment + '</strong>' +
                        ' Input your comment, please.');
                    }
                    else {
                        error.html('<strong>An error occurred while sending the comment.</strong>' +
                        ' Apply to the administrator, please.');
                    }
                }
                    error.show();
                    message.hide();
            }
        });
    });
});
/*
 $.each(data, function (i,e) {
 alert('--'+ i +'--'+ e +'--');
 });
 */
/*
 //{"comment":["The comment field is required."]} - JSON data string
 var response = JSON.parse(data.responseText);
 //The JSON.parse (str) call will turn the JSON data string
 // into a JavaScript object / array / value.
 */