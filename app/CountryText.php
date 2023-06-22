<?php

namespace App;

use App\Classes\ModelStaticTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $country_id
 * @property int $language_id
 * @property string $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CountryText extends Model
{
    use ModelStaticTable;

    protected $fillable = ['country_id', 'language_id'];
}
