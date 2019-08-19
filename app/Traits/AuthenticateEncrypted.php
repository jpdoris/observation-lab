<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait AuthenticateEncrypted
{
    use Encryptable;
    use AuthenticatesUsers {
        AuthenticatesUsers::login as parentLogin;
    }

    public function login(Request $request)
    {
        $this->parentLogin();
    }
}