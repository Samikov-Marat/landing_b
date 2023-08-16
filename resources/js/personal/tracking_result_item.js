function TrackingResultItem($templates) {
    this.$templates = $templates;
    this.setData = function (step) {
        this.step = step;
        return this;
    }
    this.getJqueryItem = function () {
        if (this.isFinalStep()) {
            return this.createFinishItem();
        } else {
            return this.createNormalItem();
        }
    }
    this.isFinalStep = function () {
        let finishStatusCode  = ['DELIVERED', 'PARTIALLY_DELIVERED', 'RETURNED', 'CANCELLED_BY_CLIENT'];
        return  finishStatusCode.includes(this.step.code);
    }
    this.createNormalItem = function () {
        $item = $templates.find('.js-tracking-detail-template-normal').clone();
        $item.find('.js-tracking-detail-date').html(this.getDateString(this.step.timestamp));
        $item.find('.js-tracking-detail-status').html(this.step.name);
        if(this.step.currentCity){
            $item.find('.js-tracking-detail-city').html(this.step.currentCity.name);
        }
        else{
            $item.find('.js-tracking-detail-city').html('');
        }
        return $item
    }
    this.createFinishItem = function () {
        $item = $templates.find('.js-tracking-detail-template-finish').clone();
        $item.find('.js-tracking-detail-date').html(this.getDateString(this.step.timestamp));
        $item.find('.js-tracking-detail-status').html(this.step.name);
        if(this.step.currentCity) {
            $item.find('.js-tracking-detail-city').html(this.step.currentCity.name);
        }
        else{
            $item.find('.js-tracking-detail-city').html('');
        }
        return $item
    }
    this.getStepProperty = function (name) {
        if (this.step.hasOwnProperty(name)) {
            return this.step[name]
        } else {
            return '';
        }
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
