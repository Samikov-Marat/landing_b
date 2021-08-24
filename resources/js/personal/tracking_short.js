function TrackingShort(response) {
    this.response = response;

    this.show = function () {
        $('.js-tracking-from-city').html(this.getProperty(['cityFrom', 'name']));
        $('.js-tracking-from-date').html(this.getProperty(['orderDate']));
        $('.js-tracking-to-city').html(this.getProperty(['cityTo', 'name']));
        $('.js-tracking-to-date').html(this.cutDate(this.getProperty(['currentDateTimeCityTo'])));
        $('.js-tracking-status').html(this.getProperty(['status', 'name']));
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
    this.cutDate = function (datetime) {
        return datetime.replace(/\s.*/, '');
    }

    this.getProperty = function (path) {
        return this.getPropertyExt(this.response, path);
    }

    this.getPropertyExt = function (from, path) {
        if (0 == path.length) {
            throw new Error('Путь имён свойтв пуст');
        }
        let name = path.shift();
        if (!from.hasOwnProperty(name)) {
            return '';
        }
        if (0 == path.length) {
            return from[name];
        } else {
            return this.getPropertyExt(from[name], path);
        }
    }

}
