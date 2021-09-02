<?php

namespace App\Classes;

use App\OurWorker;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OurWorkerRepository
{
    const SORT_STEP = 10;
    var $ourWorker;

    public static function getInstance(OurWorker $ourWorker)
    {
        return new static($ourWorker);
    }

    public function __construct($ourWorker)
    {
        $this->ourWorker = $ourWorker;
    }

    public function getTextByLanguage($language_id)
    {
        try {
            return $this->ourWorker->ourWorkerTexts()
                ->select(
                    'id',
                    'our_worker_id',
                    'language_id',
                    'name',
                    'post'
                )
                ->where('language_id', $language_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->ourWorker->ourWorkerTexts()
                ->make()->setAttribute('language_id', $language_id);
        }
    }
}
