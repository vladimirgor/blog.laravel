/**
 * Created by Владимир on 24.10.2017.
 */
$(document).ready(function(){

    $("#commentSave").submit(function(event){
        /*
        var name = $("#name").val();
        var comment = $("#comment").val();
        var email = $("#email").val();
        event.preventDefault();
        $.getJSON('InsertSelect.php',
            { name : name, comment : comment, email : email },
            processResult
        );
        */
        alert ('CommentSave');
    });

});
function processResult(json)	{
    var str = '';
    var j = 0;
    $("#name").val("");
    $("#comment").val("");
    $("#email").val("");
    $("#list").html("");
    $.each(json, function (i,e) {
        if ( j % 3 == 0  ) $("#list").append('<div class = "col-sm-1"></div>');
        j=j+1;
        if ( i % 2 == 0 ) str = 'c'; else str = 'nc';
        $("#list").append(
            '<div class="col-sm-3 ticket' +str+ '">' +
            '<p class="'+str+'1'+'">' + e.name + '</p>'+
            '<p class="'+str+'2'+ '">' + e.email + '</p>'+
            '<p class="'+str+'3'+'">'+ e.comment + '</p>'+
            '</div>');
    });
}