<h5>Телефоны</h5>

<div class="js-local-office-phone-block">
    @if(isset($localOffice))
        @foreach($localOffice->localOfficePhones as $phone)
            @include('admin.local_offices.form_phones_item',['phone'=>$phone, 'name' => 'phone_old[' . $phone->id . ']'])
        @endforeach
    @else
        @include('admin.local_offices.form_phones_item', ['phone'=>null, 'name' => 'phone_new[0]'])
    @endif
</div>

<div class="form-group">
    <button type="button" class="btn btn-outline-success js-local-office-phone-add" data-name="phone_new">
        <i class="fas fa-plus"></i> Добавить строку телефона
    </button>
</div>

<div class="alert alert-warning">
    Телефоны будут добавлены и удалены только после сохранения всего офиса
</div>
