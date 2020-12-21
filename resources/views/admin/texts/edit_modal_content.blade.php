<form method="post" action="{!! route('admin.texts.save') !!}" class="modal-content js-admin-texts-modal-content">
    @csrf
    <input type="hidden" name="site_id" value="{{ $site->id }}">
    <input type="hidden" name="text_type_id" value="{{ $textType->id }}">
    <div class="modal-header">
        <h5 class="modal-title">Внести перевод</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div>
            {{ $textType->default_value }}
        </div>
        @php
            $textsByLanguage = $textType->texts->keyBy('language_id');
        @endphp
        @foreach($site->languages as $language)
            @php
                $labelId = 'id-language-' . $language->id;
            @endphp

            <div class="form-group">
                <label for="{{ $labelId }}">{{ $language->name }}</label>
                <textarea class="form-control" id="{{ $labelId }}" name="values[{{ $language->id }}]" rows="7">{{ $textsByLanguage->has($language->id) ? $textsByLanguage->get($language->id)->value : '' }}</textarea>
            </div>

        @endforeach

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>
