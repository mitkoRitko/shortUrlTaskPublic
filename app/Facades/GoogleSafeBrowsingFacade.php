<?php

namespace App\Facades;

use App\Services\GoogleSafeBrowsing;
use Illuminate\Support\Facades\Facade;

class GoogleSafeBrowsingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GoogleSafeBrowsing::class;
    }
}