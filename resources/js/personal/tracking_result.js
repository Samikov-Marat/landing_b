function TrackingResult($div, $templates) {
    this.$div = $div;
    this.$templates = $templates;

    this.clear = function () {
        this.$div.empty();
    }

    this.fill = function (trackingDetails) {
        let n = trackingDetails.length;
        let $templates = $('.js-tracking-detail-templates');
        for (let i = 0; i < n; i++) {
            let $item = (new TrackingResultItem($templates))
                .setData(trackingDetails[i])
                .getJqueryItem();
            this.addItem($item);
        }
    }

    this.addItem = function ($item) {
        this.$div.append($item);
    }
}
