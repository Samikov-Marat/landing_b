@extends('admin.layout')

@section('header')
    Наши сотрудники
@endsection

@section('breadcrumbs')
    @include('admin.breadcrumbs', ['breadcrumbs' => [
        ['href' => route('admin.sites.index'), 'text' => 'Сайты'],
        ['text' => $site->name],
        ['text' => 'Наши сотрудники'],
    ]])
@endsection

@can('admin.our_workers.add')
    @push('buttons2')
        <a href="{!! route('admin.our_workers.add', ['site_id' => $site->id]) !!}" class="btn btn-primary"><i
                class="fas fa-plus"></i> Создать</a>
    @endpush
@endcan

@section('content')

    @if($site->ourWorkers->isNotEmpty())
        <table class="table table-hover table-bordered">
            <tr>
                <th>
                    id
                </th>
                <th>
                    Фото
                </th>
                <th>
                    Имя, должность
                </th>
                <th>
                    Сортировка
                </th>
                <th>

                </th>
            </tr>
            @foreach($site->ourWorkers as $ourWorker)
                <tr>
                    <td>
                        {{ $ourWorker->id }}
                    </td>
                    <td>
                        {{ $ourWorker->photo }}
                    </td>
                    <td>
                        @foreach($ourWorker->ourWorkerTexts as $text)
                            <div>
                                <b>{{ $text->name }}</b> {{ $text->post }}
                            </div>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <form method="post" action="{!! route('admin.our_workers.move') !!}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ourWorker->id }}">

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
                    <td class="text-nowrap">
                        <a href="{!! route('admin.our_workers.edit', ['id' => $ourWorker->id]) !!}"
                           class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
                        <button type="button" data-text="Удалить {{ $ourWorker->code }} сайта {{ $site->domain }}?"
                                data-action="{!! route('admin.our_workers.delete') !!}" data-id="{{ $ourWorker->id }}"
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
