/*CSS test banner on Sat Apr 15 2023 16:49:00 GMT+0000 (Coordinated Universal Time)*/
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
    dialog("Notify","Page loading finished");

    $.get('api/demo/modal', function(data, textSuccess){
        console.log("woriking");
    });

})
//# sourceMappingURL=app.js.map