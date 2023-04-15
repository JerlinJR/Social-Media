$(document).ready(function(){
    dialog("Notify","Page loading finished");

    $.get('api/demo/modal', function(data, textSuccess){
        console.log("woriking");
    });

})