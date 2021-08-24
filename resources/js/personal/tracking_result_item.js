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
        return 'success' == this.step.statusCode
    }
    this.createNormalItem = function () {
        $item = $templates.find('.js-tracking-detail-template-normal').clone();
        $item.find('.js-tracking-detail-date').html(this.step.date);
        $item.find('.js-tracking-detail-status').html(this.step.statusName);
        $item.find('.js-tracking-detail-city').html(this.step.cityName);
        return $item
    }
    this.createFinishItem = function () {
        $item = $templates.find('.js-tracking-detail-template-finish').clone();
        $item.find('.js-tracking-detail-date').html(this.step.date);
        $item.find('.js-tracking-detail-status').html(this.step.statusName);
        $item.find('.js-tracking-detail-city').html(this.step.cityName);
        return $item
    }
    this.getStepProperty = function (name) {
        if (this.step.hasOwnProperty(name)) {
            return this.step[name]
        } else {
            return '';
        }
    }
}
