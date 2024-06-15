<?php 

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;


class UrlService {

    public function createShortUrl(string $destinationUrl): string
    {
        // check if destination url already exists
        if(Url::destinationUrlExists($destinationUrl)) {
            return Url::where('destination_url', $destinationUrl)->first()->hash;
        }

        do {
            //create random hash
            $hash = Str::random(6);
        } while (Url::where('hash', $hash)->exists() && is_null($hash));

        Url::create([
            'destination_url' => $destinationUrl,
            'hash' => $hash
        ]);

        return $hash;
    }
}