<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GoogleSafeBrowsing
{
    protected ?string $apiKey = null;
    protected string $clientId;
    protected string $clientVersion;
    protected array $threatTypes;
    protected array $platformTypes;

    public function __construct()
    {
        $this->apiKey = config('google.key');
        $this->clientId = config('google.client_id');
        $this->clientVersion =  config('google.version');
        $this->threatTypes = config('google.threat_types');
        $this->platformTypes = config('google.threat_platforms');
    }

    /** @throws \Exception */
    public function isSafeUrl(string $url): bool
    {
        $this->checkApiKey();
        $response = $this->getApiResponse($url);

        return !$response->json('matches');
    }

    protected function checkApiKey(): void
    {
        if (is_null($this->apiKey) or empty($this->apiKey)) {
            throw new \Exception('API Key is required');
        }
    }

    protected function getApiResponse(string $url): Response
    {
        $apiDomain = config('google.safe_browsing.method');
        $lookupUrl = sprintf($apiDomain."?key=%s", $this->apiKey);
        $lookupData = [
            'client' => [
                'clientId' => $this->clientId,
                'clientVersion' => $this->clientVersion,
            ],
            'threatInfo' => [
                'threatTypes' => $this->threatTypes,
                'platformTypes' => $this->platformTypes,
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $response = Http::post($lookupUrl, $lookupData);
        if ($response->failed()) {
            \Log::error($response->json('error.message'));
            throw new \Exception('Google error');
        }

        return $response;
    }
}