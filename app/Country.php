<?php

namespace App;

use App\Classes\ModelStaticTable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $jira_code
 * @property bool can_send
 * @property bool can_receive
 */
class Country extends Model
{
    use ModelStaticTable;
    //

    public function country_text() {
        return $this->hasMany(CountryText::class);
    }
}
