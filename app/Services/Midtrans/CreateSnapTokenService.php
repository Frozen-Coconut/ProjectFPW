<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $arr;

    public function __construct($arr)
    {
        parent::__construct();

        $this->arr = $arr;
    }

    public function getSnapToken()
    {
        $snapToken = Snap::getSnapToken($this->arr);

        return $snapToken;
    }
}
