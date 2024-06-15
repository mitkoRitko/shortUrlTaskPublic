<?php

namespace Tests\Feature;

use App\Facades\GoogleSafeBrowsingFacade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoogleSafeBrowsingTest extends TestCase
{
    /** @test */
    public function can_determine_unsafe_url(): void
    {
        $this->assertFalse(GoogleSafeBrowsingFacade::isSafeUrl('http://malware.testing.google.test/testing/malware/'));
    }

    /** @test */
    public function can_determine_safe_url(): void
    {
        $facade = GoogleSafeBrowsingFacade::isSafeUrl('https://google.com');

        $this->assertTrue($facade);
    }
}
