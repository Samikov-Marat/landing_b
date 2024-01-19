function TrackingShort(result) {
    this.result = result;

    this.show = function () {
        $('.js-tracking-from-city').html(this.result.order.sender.address.city.name);
        $('.js-tracking-from-date').html('');

        for(let i = 0; i < this.result.statuses.length; i++){
            if('ACCEPTED_FOR_DELIVERY' == this.result.statuses[i].code){
                $('.js-tracking-from-date').html(this.getDateString(this.result.statuses[i].timestamp));
                break;
            }
        }

        $('.js-tracking-to-city').html(this.result.order.receiver.address.city.name);
        $('.js-tracking-to-date').html(this.getDateString(this.result.warehouse.acceptance.plannedEndDate));

        $('.js-tracking-status').html(this.result.statuses.at(-1).name);
        $('.js-tracking-result').removeClass('hidden');
    }

    this.hide = function () {
        $('.js-tracking-result').addClass('hidden');
        $('.js-tracking-from-city').html('');
        $('.js-tracking-from-date').html('');
        $('.js-tracking-to-city').html('');
        $('.js-tracking-to-date').html('');
        $('.js-tracking-status').html('');

    }

    this.getDateString = function (timestamp) {
        let date = new Date(timestamp);
        return date.toLocaleString(undefined,
            {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            })
    }


}
