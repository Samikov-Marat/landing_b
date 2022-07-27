$(function () {

    let target = $('.js-statistics-sites-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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

        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.site +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.site +
            '</div>'
        );
        return $container;
    }
});

$(function () {

    let target = $('.js-statistics-utm-source-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.utm_source +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
            ;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.utm_source +
            '</div>'
        );
        return $container;
    }
});


$(function () {

    let target = $('.js-statistics-utm-medium-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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
        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.utm_medium +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.utm_medium +
            '</div>'
        );
        return $container;
    }
});

$(function () {

    let target = $('.js-statistics-utm-campaign-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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
        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
            ;
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.utm_campaign +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.utm_campaign +
            '</div>'
        );
        return $container;
    }
});

$(function () {

    let target = $('.js-statistics-utm-term-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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
        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
            ;
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.utm_term +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.utm_term +
            '</div>'
        );
        return $container;
    }
});

$(function () {
    let target = $('.js-statistics-utm-content-search')
    target.select2({
        language: 'ru',
        width: 'resolve',
        allowClear: true,
        placeholder: 'Любые',
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
        if (repo.loading) {
            return $(
                '<div class="clearfix">' +
                'Получение списка' +
                '</div>'
            );
            ;
        }

        var $container = $(
            '<div class="clearfix">' +
            repo.utm_content +
            '</div>'
        );
        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.id == '') {
            return repo.text;
        }

        if ($(repo.element).data('old') !== undefined) {
            stat = $(repo.element).data('old');
        } else {
            stat = repo;
        }

        var $container = $(
            '<div class="clearfix">' +
            stat.utm_content +
            '</div>'
        );
        return $container;
    }
});


$(function () {
    $('.js-statistics-sites-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-utm-source-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-utm-medium-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-utm-campaign-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-utm-term-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-utm-content-search').on('select2:select select2:unselect', function () {
        $(this).closest('form').submit();
    });
    $('.js-statistics-send-form').on('change', function () {
        $(this).closest('form').submit();
    });
})
