/**
 * Created by Владимир on 26.10.2017.
 */
$(document).ready(function(){
    $('#comment_form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/ajaxComment',
            data: $('#comment_form').serialize(),
            success: function(data){
                if(data.result)
                {
                    $('#comment_error').hide();
                    $('#comment_message').show();
                }
                else
                {
                    $('#comment_error').show();
                    $('#comment_message').hide();
                }
            },
            error: function(data){
                //{"comment":["The comment field is required."]} -
                if (data.responseText.indexOf("comment",2) >= 0 )
                {
                   $('#comment_error').html('<strong>' + data.responseText.substr(13,30) + '</strong>' +
                    ' Input your comment, please.');
                }
                else
                {
                   $('#comment_error').html('<strong>An error occurred while sending the comment.</strong>' +
                   ' Apply to the administrator, please.');
                }
                    $('#comment_error').show();
                    $('#comment_message').hide();

            }
        });
    });
});