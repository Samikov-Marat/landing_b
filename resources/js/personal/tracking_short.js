function TrackingShort(result) {
    this.result = result;

    this.show = function () {
        let startPoint = -1;
        for(let i = 0; i < result.statuses.length; i++){
            if(result.statuses[i].currentCity){
                startPoint = result.statuses[i];
                break;
            }
        }
        $('.js-tracking-from-city').html(startPoint.currentCity.name);
        $('.js-tracking-from-date').html(this.getDateString(startPoint.timestamp));

        let endPoint = result.statuses.length;
        for(let i = result.statuses.length - 1; i >= 0; i--){
            if(result.statuses[i].currentCity){
                endPoint = result.statuses[i];
                break;
            }
        }
        $('.js-tracking-to-city').html(endPoint.currentCity.name);
        $('.js-tracking-to-date').html(this.getDateString(endPoint.timestamp));
        $('.js-tracking-status').html(endPoint.name);
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
