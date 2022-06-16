@foreach($tree as $node)
    <tr>
        <td>
            <div style="display: flex; flex-wrap: nowrap; justify-content: flex-start;">
                @for($i = 0; $i < $level; $i++)
                    <div>
                        @if($ruler[$i])
                            @include('admin.support_categories.line', ['symbol' => 'vertical'])
                        @else
                            @include('admin.support_categories.line', ['symbol' => 'o'])
                        @endif
                    </div>
                @endfor
                <div>
                    @if($loop->last)
                        @include('admin.support_categories.line', ['symbol' => 'l'])
                    @else
                        @include('admin.support_categories.line', ['symbol' => 'cross'])
                    @endif
                </div>
                <div>

                    @if($node->subCategories->isEmpty())
                        @include('admin.support_categories.line', ['symbol' => 'horizont'])
                    @else
                        @include('admin.support_categories.line', ['symbol' => 't'])
                    @endif

                </div>
                <div>
                    &nbsp;&nbsp;&nbsp;{{ $node->supportCategoryTexts ? $node->supportCategoryTexts[0]->name : $node->id }}
                    [ {{ $node->sort }} ]
                </div>
            </div>
        </td>

        <td>
            <a href="{!! route('admin.support_questions.index', ['category_id' => $node->id]) !!}">Вопросы</a>
        </td>

        <td class="text-center">
            <form method="post" action="{!! route('admin.support_categories.move') !!}">
                @csrf
                <input type="hidden" name="id" value="{{ $node->id }}">
                @if (!$loop->first)
                    <button type="submit" name="direction" value="up" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                @endif
                @if (!$loop->last)
                    <button type="submit" name="direction" value="down" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                @endif
            </form>
        </td>

        <td class="text-nowrap">
            <a href="{!! route('admin.support_categories.add', ['site_id' => $site->id, 'parent_id' => $node->id]) !!}"
               class="btn btn-primary btn-sm"><i
                    class="fas fa-plus"></i> Добавить подкатегорию</a>

            <a href="{!! route('admin.support_categories.edit', ['id' => $node->id]) !!}"
               class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
            <button type="button" data-text="Удалить ?"
                    data-action="{!! route('admin.support_categories.delete') !!}" data-id="{{ $node->id }}"
                    class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
            </button>
        </td>

    </tr>

    @php
        $rulerNext = $ruler;
        $rulerNext[$level] = $loop->last ? 0 : 1;
        $rulerNext[] = 1;
    @endphp

    @include('admin.support_categories.branch', ['site' => $site, 'tree' => $node->subCategories, 'level' => $level + 1, 'ruler' => $rulerNext ])

@endforeach
