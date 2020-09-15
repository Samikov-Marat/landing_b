$(function (){

    var xhrLoadForm = null;
    $('.js-admin-texts-line-page').on('click', 'td', function (){


        $('.js-admin-texts-modal-dialog').empty();
        $('.js-admin-texts-modal-content-dummy').find('.modal-content').clone().appendTo('.js-admin-texts-modal-dialog');

        $('#id_modal_admin_texts_edit').modal('show');

        let url = $(this).closest('tr').data('url');

        xhrLoadForm = $.ajax({'url' : url, 'method' : 'GET', 'dataType': 'html'})
            .done(function(data){
                $('.js-admin-texts-modal-dialog').html(data);
                xhrLoadForm = null;
            });

    });

    $('#id_modal_admin_texts_edit').on('bs.modal.hide', function(){
        if(xhrLoadForm !== null){
            xhrLoadForm.abort();
        }
    });



});
