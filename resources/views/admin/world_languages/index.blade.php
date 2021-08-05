@extends('admin.layout')

@section('header')
    Международные языки
@endsection


@can('admin.world_languages.add')
    @push('buttons2')
        <a href="{!! route('admin.world_languages.add') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($worldLanguages->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                @can('admin.world_languages.move')
                    <th>
                        Сортировка
                    </th>
                @endcan
                <th>

                </th>
            </tr>
            @foreach($worldLanguages as $worldLanguage)
                <tr>
                    <td>
                        {{ $worldLanguage->language_code_iso }}
                    </td>
                    <td>
                        {{ $worldLanguage->name }}
                    </td>
                    @can('admin.world_languages.move')
                        <td class="text-center">
                            <form method="post" action="{!! route('admin.world_languages.move') !!}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $worldLanguage->id }}">

                                @if (!$loop->first)
                                    <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm"
                                            title="Вверх">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                @endif
                                @if (!$loop->last)
                                    <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm"
                                            title="Вниз">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                @endif

                            </form>
                        </td>
                    @endcan

                    <td class="text-nowrap">
                        <a href="{!! route('admin.world_languages.edit', ['id' => $worldLanguage->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $worldLanguage->language_code_iso }} {{ $worldLanguage->name }}?"
                                data-action="{!! route('admin.world_languages.delete') !!}" data-id="{{ $worldLanguage->id }}"
                                class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <span class="alert alert-info">Список пуст.</span>
    @endif
@endsection
