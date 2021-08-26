$(function () {

    var xhrLoadForm = null;
    $('.js-admin-texts-line-page').on('click', 'td', function () {


        $('.js-admin-texts-modal-dialog').empty();
        $('.js-admin-texts-modal-content-dummy').find('.modal-content').clone().appendTo('.js-admin-texts-modal-dialog');

        $('#id_modal_admin_texts_edit').modal('show');

        let url = $(this).closest('tr').data('url');

        xhrLoadForm = $.ajax({'url': url, 'method': 'GET', 'dataType': 'html'})
            .done(function (data) {
                $('.js-admin-texts-modal-dialog').html(data);
                xhrLoadForm = null;
            });

    });

    $('#id_modal_admin_texts_edit').on('bs.modal.hide', function () {
        if (xhrLoadForm !== null) {
            xhrLoadForm.abort();
        }
    });

    function escapeRegExp(string) {
        return string.replace(/[.*+\-?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
    }

    $('.js-admin-texts-filter').on('input', function () {
        let inputValue = $(this).val();
        let pattern = new RegExp(escapeRegExp(inputValue), 'i');
        $('.js-admin-texts-line-for-filter').each(function () {
            let needShow = false;
            if(inputValue !== ''){
                $(this).find('.js-admin-texts-td-for-filter').each(function () {
                    if(isIncluded($(this).attr('data-text'), pattern)){
                        needShow = true;
                        return false;
                    }
                });
            }
            else{
                needShow = true;
            }
            $(this).toggle(needShow);
        });
    });

    function isIncluded(text, pattern){
        return -1 != text.search(pattern);
    }


    //
    // $('body').on('keyup', function(e) {
    //     if (e.key == "Escape") {
    //         $('.js-admin-texts-filter').val('');
    //         $('.js-admin-texts-filter').trigger('input');
    //         $('.js-admin-texts-filter').focus();
    //     }
    // });


    $('.js-admin-texts-filter-clear').on('click', function() {
        $('.js-admin-texts-filter').val('');
        $('.js-admin-texts-filter').trigger('input');
        $('.js-admin-texts-filter').focus();
    });


});
