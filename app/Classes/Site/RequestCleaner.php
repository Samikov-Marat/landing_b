<?php

namespace App\Classes\Site;

use Illuminate\Http\Request;

class RequestCleaner
{
    private $clearedParams;
    private $allows = ['#utm_.*#', '#gclid.*#', '#yclid.*#'];

    private $changed;

    public function __construct(Request $request)
    {
        $this->changed = false;
        $this->clearedParams = $this->clear($request->input());
    }

    private function clear($input): array
    {
        $result = new RequestCleanerResult();
        foreach ($input as $k => $v) {
            if (is_array($v)) {
                $clearedParam = $this->clear($v);
                $result->addOnlyNotEmpty($k, $clearedParam);
                continue;
            }
            if ($this->isAllow($k)) {
                $result->add($k, $v);
                continue;
            }
            $this->changed = true;
        }
        return $result->getArray();
    }

    private function isAllow($k): bool
    {
        foreach ($this->allows as $allow) {
            if (preg_match($allow, $k)) {
                return true;
            }
        }
        return false;
    }

    public function getCleared(): array
    {
        return $this->clearedParams;
    }

    public function isChanged(): bool
    {
        return $this->changed;
    }
}
