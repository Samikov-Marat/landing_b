<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $site_id
 * @property int $page_id
 * @property string $url
 * @property string $path
 * @property string $name
 * @property bool $is_download файл для скачивания
 * @property int $sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read bool $is_image
 */
class Image extends Model
{
    protected $appends = ['is_image'];

    /**
     * Определить, является ли файл изображением
     */
    public function getIsImageAttribute(): bool
    {
        $path = Storage::disk('images')->path($this->path);
        if(File::isFile($path)){
            $mimeType = \Illuminate\Support\Facades\File::mimeType($path);
            if (strpos($mimeType, 'image') !== false) {
                return true;
            }
        }
        return false;
    }
}
