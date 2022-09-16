<?php

namespace App\Fields;

class OTP extends Field
{
    public function component()
    {
        return 'OtpInput';
    }

    public function submitOnComplete()
    {
        $this->set('binds.submitOnComplete', true);

        return $this;
    }

    public function justify($justify)
    {
        $this->set('binds.justify', $justify);

        return $this;
    }
}
