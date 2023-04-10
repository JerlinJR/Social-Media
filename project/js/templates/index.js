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
                $(`#post-${post_id}`).remove();
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