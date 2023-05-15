<?php

namespace App;

use App\Classes\ModelStaticTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $jira_code
 * @property bool can_send
 * @property bool can_receive
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Country extends Model
{
    use ModelStaticTable;
    //

    public function countryText(): HasMany {
        return $this->hasMany(CountryText::class);
    }
}
