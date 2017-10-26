/**
 * Created by Владимир on 26.10.2017.
 */
$(document).ready(function(){
    $('#comment_form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/ajax-comment',
            data: $('#comment_form').serialize(),
            success: function(result){
                console.log(result);
            }
        });
    });
});