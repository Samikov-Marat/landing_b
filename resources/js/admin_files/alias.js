$(function () {

    let target = $('.js-alias-site-search')
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
        let $container = $(
            '<div class="clearfix">' +
            '<samp style="background: #9affc6">' + repo.domain + '</samp> ' +
            repo.name +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if ($(repo.element).data('old') !== undefined) {
            site = $(repo.element).data('old');
        } else {
            site = repo;
        }

        let $container = $(
            '<div class="clearfix">' +
            '<samp style="background: #9affc6">' + site.domain + '</samp> ' +
            site.name +
            '</div>'
        );
        return $container;
    }
});
