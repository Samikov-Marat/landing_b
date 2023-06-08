<form method="post" action="{!! route('admin.currency.store') !!}">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Код валюты</span>
                <input type="number" class="form-control" aria-describedby="addon-wrapping" name="code">
            </div>
        </div>

        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Название</span>
                <input type="text" class="form-control" aria-describedby="addon-wrapping" name="name">
            </div>
        </div>

        <div class="col">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Символ</span>
                <input type="text" class="form-control" aria-describedby="addon-wrapping" name="symbol">
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-success">Cоздать</button>
        </div>
    </div>
</form>