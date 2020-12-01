<?php

namespace App\Classes;

use App\Mail\admin\users\PasswordMail;
use Illuminate\Support\Facades\Mail;

class UserPasswordNotification
{
    var $password = '';
    var $needSend = false;

    public function setPassword($password)
    {
        $this->password = $password;
        $this->needSend = true;
    }

    public function sendTo($user)
    {
        if ($this->needSend) {
            Mail::to($user->email)
                ->send(new PasswordMail($user, $this->password));
        }
    }
}
