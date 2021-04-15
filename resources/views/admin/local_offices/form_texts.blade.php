<h5>Название на разных языках</h5>

@php
    $names = collect();
    if(isset($localOffice)){
        $names = $localOffice->localOfficeTexts->pluck('name', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="name[{{ $language->id }}]"
                   value="{{ isset($names[$language->id]) ? $names[$language->id] : '' }}"
                   placeholder="Название" autocomplete="off">
        </div>
    @endforeach
</div>


<h5>Адрес на разных языках</h5>

@php
    $addresses = collect();
    if(isset($localOffice)){
        $addresses = $localOffice->localOfficeTexts->pluck('address', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="address[{{ $language->id }}]"
                   value="{{ isset($addresses[$language->id]) ? $addresses[$language->id] : '' }}"
                   placeholder="Адрес" autocomplete="off">
        </div>
    @endforeach
</div>


<h5>Ориентир, подсказка пути на разных языках</h5>

@php
    $paths = collect();
    if(isset($localOffice)){
        $paths = $localOffice->localOfficeTexts->pluck('path', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="path[{{ $language->id }}]"
                   value="{{ isset($paths[$language->id]) ? $paths[$language->id] : '' }}"
                   placeholder="Ориентир" autocomplete="off">
        </div>
    @endforeach
</div>

<h5>Время работы офиса на разных языках</h5>

@php
    $worktimes = collect();
    if(isset($localOffice)){
        $worktimes = $localOffice->localOfficeTexts->pluck('worktime', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="worktime[{{ $language->id }}]"
                   value="{{ isset($worktimes[$language->id]) ? $worktimes[$language->id] : '' }}"
                   placeholder="Время работы" autocomplete="off">
        </div>
    @endforeach
</div>
