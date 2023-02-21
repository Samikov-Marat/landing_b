<div class="form-row">

    <div class="form-group col-md-6">
        <label>{{ $label }}</label>
        <input type="file" name="{{ $inputName }}" class="form-control-file">
    </div>

    <div class="form-group col-md-6">
    @if(isset($newsArticle) && !is_null($newsArticle->getAttribute($attribute)))
        @if(false !== ($size = getimagesize(Storage::disk('franchisee_news_images')->path($newsArticle->getAttribute($attribute)))))
            {{ $size[0] }}x{{ $size[1] }}
        @endif
        {{ $newsArticle->getAttribute($attribute) }}<br>
        <img src="{{ Storage::disk('franchisee_news_images')->url($newsArticle->getAttribute($attribute))  }}" style="max-width: 200px; max-height: 200px;" />

    @endif
    </div>
</div>
