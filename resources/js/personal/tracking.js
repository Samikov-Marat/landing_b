$(function () {

    let trackingApiClass = function (url) {
        this.url = url;
        this.getSettings = function (serviceParameters) {
            return {
                method: 'post',
                url: this.url,
                headers: {
                    "content-type": "application/json;charset=UTF-8"
                },
                data: JSON.stringify(serviceParameters),
                xhrFields: {
                    withCredentials: false
                }
            }
        }
    };

    let $form = $('.js-tracking-form');

    let trackingApi = new trackingApiClass($form.prop('action'));
    let trackingResult = new TrackingResult($('.js-tracking-detail-items'));



    $form.submit(function () {

        if (hasError()) {
            return false;
        }

        let orderParameters = {
            'enableTrace': true,
            'lang': $(this).find('[name=lang]').val(),
            'orderNumber': $form.find('[name=order]').val(),
        };

        let $phone = $form.find('[name=phone]');
        if (!$phone.prop('disabled')) {
            orderParameters["numbersReceiverPhone"] = $phone.val();
        }

        let trackingEvent = $form.data('trackingEvent');
        if(trackingEvent !== undefined){
            $('body').trigger('gtm:event', [trackingEvent]);
        }


        $.post(trackingApi.getSettings(orderParameters))
            .fail(function (jqXHR, textStatus, errorThrown) {

                let isWarning = (400 == jqXHR.status)
                    && jqXHR.hasOwnProperty('responseJSON')
                    && jqXHR.responseJSON.hasOwnProperty('alerts')
                    && (jqXHR.responseJSON.alerts instanceof Array)
                    && (jqXHR.responseJSON.alerts.length > 0);

                if (isWarning && 'cant_determine_order_without_phone' == jqXHR.responseJSON.alerts[0].errorCode) {
                    showPhone($form);
                } else if (isWarning) {
                    $('.js-tracking-error').html(jqXHR.responseJSON.alerts[0].msg);
                    $('.js-tracking-error').removeClass('hidden');
                } else {
                    $('.js-tracking-request-error').removeClass('hidden');
                }

            })
            .done(function (response) {
                showResult(response);
            });


        return false;
    });


    function showPhone() {
        let $phone = $form.find('[name=phone]');
        $('.js-tracking-phone-postfix').removeClass('hidden');
        $phone.prop('disabled', false);
        $phone.focus();
    }

    function hidePhone() {
        let $phone = $form.find('[name=phone]');
        $('.js-tracking-phone-postfix').addClass('hidden');
        $phone.prop('disabled', true);
        $phone.val('');
    }

    function showResult(response) {
        (new TrackingShort(response.result)).show();
        trackingResult.clear();
        trackingResult.fill(response.result.statuses);
    }

    $('.js-tracking-show-details').click(function () {
        $('.js-tracking-detail-block').toggleClass('hidden');
        return false;
    });


    $form.on('input change cut paste', '.js-tracking-order-number', function () {
        hidePhone();
        $('.js-tracking-error').addClass('hidden');
        $('.js-tracking-request-error').addClass('hidden');

        (new TrackingShort()).hide();

        $('.js-tracking-detail-block').addClass('hidden');
        trackingResult.clear();
    });

    $form.on('input change cut paste', '[name=order],[name=phone]', function () {
        $(this).closest('.form-field').removeClass('form-field_error');
    });

    function hasError() {
        let result = false;
        let $order = $form.find('[name=order]');
        if ($.trim($order.val()) == '') {
            $order.closest('.form-field').addClass('form-field_error')
            result = true;
        }
        let $phone = $form.find('[name=phone]');
        if ((!$phone.prop('disabled')) && !$phone.val().match(/\d{4}/)) {
            $phone.closest('.form-field').addClass('form-field_error')
            result = true;
        }
        return result;
    }

});


