<h5>Email (почтовые адреса)</h5>

<div class="js-local-office-email-block">
    @if(isset($localOffice))
        @foreach($localOffice->localOfficeEmails as $email)
            @include('admin.local_offices.form_emails_item',['email'=>$email, 'name' => 'email_old[' . $email->id . ']'])
        @endforeach
    @else
        @include('admin.local_offices.form_emails_item', ['email'=>null, 'name' => 'email_new[0]'])
    @endif
</div>

<div class="form-group">
    <button type="button" class="btn btn-success js-local-office-email-add" data-name="email_new">Добавить строку
        телефона
    </button>
</div>

<div class="alert alert-warning">
    Почтовые адреса будут добавлены и удалены только после сохранения всего офиса
</div>
