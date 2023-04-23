/*CSS test banner on Sun Apr 23 2023 04:36:40 GMT+0000 (Coordinated Universal Time)*/
// init Masonry
var $grid = $('#masonry-area').masonry({
// itemSelector: '.col',
// columnWidth: '.col',
percentPosition: true
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
$grid.masonry('layout');
});

$.post('/api/posts/count', {
    id: 10
}, function(data) {
    console.log(data);
    $('#total-posts').html("Total Posts: " + data.counts);
});

$('.btn-delete').on('click', function(){
    post_id = $(this).parent().attr('data-id');
    d = new Dialog("Delete Post","Are you sure want to remove this post");
    d.setButtons([
        {
            'name': "Delete",
            'class': "btn-danger",
            'onClick': function(event){
                console.log(`Assume that the Post ${post_id} is deleted`);
                // $(`#post-${post_id}`).remove();

                $.post('/api/posts/delete',
                {
                    id: post_id
                }, function(data,textSuccess){
                    console.log(textSuccess);
                    console.log(data);
                    if(textSuccess == "success"){
                        $(`#post-${post_id}`).remove();
                    }
                });
                $(event.data.modal).modal('hide');   
            }
        },
        {
            'name': "Cancel",
            'class': "btn-primary",
            'onClick': function(event){
                $(event.data.modal).modal('hide');
            }
        }

    ])
    d.show();
});
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


    $('#fetchModal').on('click',function(){
        $.get('api/demo/modal', function(data, textSuccess){
            $('main#mainel').append(data)
        });
    });

})


//# sourceMappingURL=app.js.map