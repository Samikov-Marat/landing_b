<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\SitePage
 *
 * @property int $id
 * @property int $site_id
 * @property int $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SitePage extends Pivot
{
}
