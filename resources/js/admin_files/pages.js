$(function (){

    $('.js-page-is-layout-checkbox').on('click', function (){
        let urlFieldSelector = $(this).data('url_field');
        $(urlFieldSelector).prop('disabled', $(this).prop('checked'));
    });


});
