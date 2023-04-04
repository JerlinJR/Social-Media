/*CSS test banner on Tue Apr 04 2023 08:57:35 GMT+0000 (Coordinated Universal Time)*/
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

//# sourceMappingURL=app.js.map