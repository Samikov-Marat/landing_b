<div class="container">
    <div class="row">
        <div class="col-6">

            <a href="{!! route('admin.texts.download', ['site_id' => $site->id]) !!}" class="btn btn-success" target="_blank"><i class="fas fa-download"></i> Получить csv файл</a>

        </div>
        <div class="col-6">

            <form method="post" action="{!! route('admin.texts.upload') !!}" enctype="multipart/form-data" class="form-inline">
                {!! csrf_field() !!}
                <input type="hidden" name="site_id" value="{{ $site->id }}">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Выбрать</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Применить csv файл</button>
            </form>

        </div>
    </div>
</div>



