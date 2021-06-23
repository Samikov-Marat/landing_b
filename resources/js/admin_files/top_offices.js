$(function () {

    let target = $('.js-top-office-code-search')
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
            '<samp style="background: #9affc6">' + repo.code + '</samp> ' +
            repo.full_address +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        var $container = $(
            '<div class="clearfix">' +
            '<samp style="background: #9affc6">' + repo.code + '</samp> ' +
            repo.full_address +
            '</div>'
        );
        return $container;
    }
});
