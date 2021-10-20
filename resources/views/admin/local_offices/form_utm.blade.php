<div class="form-group">
    <label for="id_utm_tag">UTM-параметр</label>
    <input type="text" class="form-control" name="utm_tag" id="id_utm_tag"
           value="{{ isset($localOffice) ? $localOffice->utm_tag : '' }}"
           placeholder="Обозначение" autocomplete="off">
    <small id="id_utm_tag_help" class="form-text text-muted">UTM параметр, например <q>utm_campaign</q></small>
</div>

<div class="form-group">
    <label for="id_utm_value">Значение UTM-параметра</label>
    <input type="text" class="form-control" name="utm_value" id="id_utm_value"
           value="{{ isset($localOffice) ? $localOffice->utm_value : '' }}"
           placeholder="Обозначение" autocomplete="off">
    <small id="id_utm_value_help" class="form-text text-muted">Из метрики</small>
</div>

<div class="form-group">
    <label for="id_category">Код категории api-marketing</label>
    <input type="text" class="form-control" name="category" id="id_category"
           value="{{ isset($localOffice) ? $localOffice->category : '' }}"
           maxlength="15"
           placeholder="Обозначение" autocomplete="off">
    <small id="id_category_help" class="form-text text-muted">Строка. Например, <q>es</q> или <q>gb-ipswich</q></small>
</div>
