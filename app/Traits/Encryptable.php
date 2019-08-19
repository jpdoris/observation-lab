<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            // we must first make there's something to decrypt here, or else decrypt will
                // fail due to invalid JSON    ¯\_(ツ)_/¯
            if (!empty($value)) {
                $value = Crypt::decrypt($value);
            }

        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }
}