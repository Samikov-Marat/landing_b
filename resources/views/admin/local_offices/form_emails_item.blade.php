<div class="form-row align-items-center js-local-office-email-item">
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Email</div>
            </div>
            <input type="text" class="form-control js-local-office-email-text" placeholder="name@domain.com"
                   name="{{ $name . '[email]' }}"
                   value="{{ isset($email) ? $email->email : '' }}">
        </div>
    </div>

    <div class="col-auto">
        <button type="button" class="btn btn-outline-danger mb-2 js-local-office-email-delete">
            <i class="fas fa-trash"></i> Удалить
        </button>
    </div>
</div>
