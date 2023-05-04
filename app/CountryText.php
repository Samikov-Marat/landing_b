<?php

namespace App;

use App\Classes\ModelStaticTable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $country_id
 * @property int $language_id
 * @property string $value
 */
class CountryText extends Model
{
    use ModelStaticTable;
}
