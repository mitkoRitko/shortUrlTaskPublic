<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function redirect(string $hash)
    {
        if( !is_null($hash) && Url::hashExists($hash) ){
            $destinationUrl = Url::where('hash', $hash)->first()->destination_url;
            return Redirect::to($destinationUrl);
        }
    }
}
