<h5>Имя сотрудника</h5>

@php
    $names = collect();
    if(isset($ourWorker)){
        $names = $ourWorker->ourWorkerTexts->pluck('name', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="name[{{ $language->id }}]"
                   value="{{ isset($names[$language->id]) ? $names[$language->id] : '' }}"
                   placeholder="Имя" autocomplete="off">
        </div>
    @endforeach
</div>


<h5>Должность</h5>

@php
    $posts = collect();
    if(isset($ourWorker)){
        $posts = $ourWorker->ourWorkerTexts->pluck('post', 'language_id');
    }
@endphp

<div class="row">
    @foreach($site->languages as $language)
        <div class="form-group col">
            <label>{{ $language->name }}</label>
            <input type="text" class="form-control" name="post[{{ $language->id }}]"
                   value="{{ isset($posts[$language->id]) ? $posts[$language->id] : '' }}"
                   placeholder="Должность" autocomplete="off">
        </div>
    @endforeach
</div>
