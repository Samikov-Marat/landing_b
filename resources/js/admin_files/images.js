$(function(){
    $('.image_file_autocomplete_from').on('change', function (){
        $('.url_autocomplete_to').val('/' + $(this)[0].files[0].name);
    });
});
