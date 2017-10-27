/**
 * Created by Владимир on 26.10.2017.
 */
$(document).ready(function(){
    $('#comment_form').on('submit', function(e){
        e.preventDefault();
        var error = $('#comment_error');
        var message = $('#comment_message')
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
                var response = data.responseText;
                //{"comment":["The comment field is required."]} -
                if ( response.indexOf("comment",2) >= 0 )
                {
                   error.html('<strong>' + response.substr(13,30) + '</strong>' +
                    ' Input your comment, please.');
                }
                else
                {
                   error.html('<strong>An error occurred while sending the comment.</strong>' +
                   ' Apply to the administrator, please.');
                }
                    error.show();
                    message.hide();

            }
        });
    });
});