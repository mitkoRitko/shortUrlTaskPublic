<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlStoreRequest;
use App\Services\UrlService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store(UrlStoreRequest $urlStoreRequest, UrlService $urlService)
    {
        $hash = $urlStoreRequest->handle($urlService);

        return response([
            'short_url' => config('app.url') . '/something/' . $hash
        ], 200);
    }
}
