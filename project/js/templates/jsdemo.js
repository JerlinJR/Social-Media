$(document).ready(function(){
    dialog("Notify","Page loading finished");

    $.get('api/demo/modal', function(data, textSuccess){
        $('main#mainel').append(data)
    });

})

