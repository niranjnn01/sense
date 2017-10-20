$(document).ready(function () {

        $('.delete_image').click(function (event) {
            event.preventDefault();
            if( confirm("Are you sure you want to delete this image ? \n This action cannot be undon.") ) {
                gotoPage('gallery/delete/' + $(this).attr('data-id'));
            }
        });
});
