$(function () {

    let target = $('.js-languages-code-search')
    target.select2({
        language: 'ru',
        ajax: {
            url: target.data('ajaxUrl'),
            dataType: 'json',
            data: function (params) {
                var query = {
                    term: params.term,
                    page: params.page || 1
                }
                return query;
            }
        },
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        var $container = $(
            '<div class="clearfix">' +
            '<samp style="background: #9affc6">' + repo.code_iso + '</samp> ' +
            repo.name +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if ($(repo.element).data('old') !== undefined) {
            office = $(repo.element).data('old');
        } else {
            office = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            '<samp style="background: #9affc6">' + office.code_iso + '</samp> ' +
            office.name +
            '</div>'
        );
        return $container;
    }


});
