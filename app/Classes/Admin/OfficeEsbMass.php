<?php

namespace App\Classes\Admin;

use App\OfficeUuid;
use Illuminate\Support\Facades\Storage;

class OfficeEsbMass
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function process()
    {
        $handler = fopen(Storage::path($this->file), 'r');
        $buffer = [];
        OfficeUuid::truncate();
        while (false !== ($line = fgetcsv($handler))) {
            $buffer[] = ['uuid' => $line[0]];
        }
        OfficeUuid::insert($buffer);
        fclose($handler);
    }

}
