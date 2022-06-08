@foreach($tree as $node)
    <tr>
        <td>
            <div style="display: flex; flex-wrap: nowrap; justify-content: flex-start;">
                @for($i = 0; $i < $level; $i++)
                    <div style="width:100px;"> &nbsp;</div>
                @endfor
                <div>

                    {{ $node->supportCategoryTexts ? $node->supportCategoryTexts[0]->name : $node->id }}
                </div>
            </div>
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
            <a href="{!! route('admin.support_categories.edit', ['id' => $node->id]) !!}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Редактировать</a>
            <button type="button" data-text="Удалить ?"
                    data-action="{!! route('admin.support_categories.delete') !!}" data-id="{{ $node->id }}"
                    class="btn btn-danger btn-sm js-delete-confirm"><i class="fas fa-trash"></i> Удалить
            </button>
        </td>

    </tr>
    <tr>
        <td>
            <div style="display: flex; flex-wrap: nowrap; justify-content: flex-start;">
                @for($i = 0; $i < $level+ 1; $i++)
                    <div style="width:100px;"> &nbsp;</div>
                @endfor
                <div>
                    <a href="{!! route('admin.support_categories.add', ['site_id' => $site->id, 'parent_id' => $node->id]) !!}"><i
                            class="fas fa-plus"></i> Добавить подкатегорию</a>
                </div>
            </div>
        </td>
    </tr>
    @include('admin.support_categories.branch', ['site' => $site, 'tree' => $node->subCategories, 'level' => $level + 1])

@endforeach
