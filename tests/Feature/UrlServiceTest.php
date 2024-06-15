<?php

namespace Tests\Feature;

use App\Services\UrlService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlServiceTest extends TestCase
{
    /** @test */
    public function will_create_short_link()
    {
        $urlService = new UrlService();

        $urlService->createShortUrl('https://google.com');

        $this->assertDatabaseCount('short_urls', 1);
    }
    
    /** @test */
    public function will_return_hash_if_destination_url_exists()
    {
        $urlService = new UrlService();

        $hash = $urlService->createShortUrl('https://google.com');

        $hash2 = $urlService->createShortUrl('https://google.com');

        $this->assertEquals($hash, $hash2);
    }
}
