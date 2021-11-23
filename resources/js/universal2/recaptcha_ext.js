function RecaptchaExt() {

    this.recaptchaAction = '';
    this.setRecaptchaAction = function (recaptchaAction) {
        this.recaptchaAction = recaptchaAction;
    }

    this.execute = function(sendform)
    {
        grecaptcha.ready(function () {
            let key = $('#recaptcha_script').data('key');
            grecaptcha.execute(key, {action: this.recaptchaAction})
                .then(function (token) {
                    sendform(token);
                });
        });

    }
}
