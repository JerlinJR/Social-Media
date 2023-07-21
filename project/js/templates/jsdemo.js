$(document).ready(function(){
    // dialog("Notify","Page loading finished");
    console.log("Page Loaded Sucessfully")

    $('#exampleModal').on('show.bs.modal', function(){
        console.log("Modal is being shown")
    });

    $('#exampleModal').on('shown.bs.modal', function(){
        console.log("Modal is been shown")
    });

    $('#exampleModal').on('hide.bs.modal', function(){
        console.log("Modal is being hide")
    });

    $('#exampleModal').on('hidden.bs.modal', function(){
        console.log("Modal is been hide")
    });

    $('#testtext').on('keydown', function(){
        console.log("Key is pressed")
    });

    $('#testtext').on('keyup', function(){
        console.log("Key is released")
    });

    $('#fetchModal').on('click',function(){
        $.get('api/demo/modal', function(data, textSuccess){
            $('main#mainel').append(data)
        });
    });

})

