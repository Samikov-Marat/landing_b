let oldId = 1;

function generateId() {
    oldId++;
    return oldId;
}

$(function () {
    $('.js-local-office-phone-add').click(function () {
        let $item = $('.js-local-office-phone-template .js-local-office-phone-item').clone();

        let nameStart = $(this).data('name') + '[' + generateId() + ']';

        $item.find('.js-local-office-phone-text').prop('name', nameStart + '[phone_text]');
        $item.find('.js-local-office-phone-value').prop('name', nameStart + '[phone_value]');

        $('.js-local-office-phone-block').append($item);
        return false;
    });

    $('.js-local-office-phone-block').on('click', '.js-local-office-phone-delete', function () {
        $(this).closest('.js-local-office-phone-item').remove();
    });

    $('.js-local-office-email-add').click(function () {
        let $item = $('.js-local-office-email-template .js-local-office-email-item').clone();

        let nameStart = $(this).data('name') + '[' + generateId() + ']';

        $item.find('.js-local-office-email-text').prop('name', nameStart + '[email]');


        $('.js-local-office-email-block').append($item);
        return false;
    });

    $('.js-local-office-email-block').on('click', '.js-local-office-email-delete', function () {
        $(this).closest('.js-local-office-email-item').remove();
    });
});
