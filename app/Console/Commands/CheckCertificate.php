<?php

namespace App\Console\Commands;

use App\CertificateChecks;
use App\Classes\Admin\CertificateChecker;
use App\Site;
use Illuminate\Console\Command;

class CheckCertificate extends Command
{
    protected $signature = 'certificate:check';
    protected $description = 'Проверка сертификатов на всех лендингах и сохранение результатов проверки в БД';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sites = Site::select('id', 'domain')->get();
        $needSleep = false;
        foreach ($sites as $site) {
            if ($needSleep) {
                sleep(1);
            }
            $check = CertificateChecks::findOrNew($site->id);
            $check->site_id = $site->id;
            try {
                $check->valid_to = CertificateChecker::getInstance($site->domain)->getTimestamp();
            } catch (\Exception $e) {
                $check->error = $e->getMessage();
            }
            $check->save();
            $needSleep = true;
        }

        return 0;
    }
}
