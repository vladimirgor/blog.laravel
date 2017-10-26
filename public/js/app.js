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
            error: function(){
                $('#comment_error').show();
                $('#comment_message').hide();
            }
        });
    });
});