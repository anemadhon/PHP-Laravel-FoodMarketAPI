<?php

namespace App\Helpers;

use Midtrans\Config;

/**
 * Midtrans Configuration.
 */
class MidtransConfiguration
{
    /**
    * Configuration
    */
    public static function index()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }
}