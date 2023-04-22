<?php

namespace App\Mail\site\support;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForwardMail extends Mailable
{
    use Queueable, SerializesModels;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function build()
    {
        return $this->view('site.universal2.support_mail_forward')
            ->with('request', $this->request);
    }
}
