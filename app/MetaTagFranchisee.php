<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

// Привязывает мета-тег к франчайзи
// Если нет привязки - то это мета-тег основного сайта
// Немного странно получилось
class MetaTagFranchisee extends Pivot
{

}
