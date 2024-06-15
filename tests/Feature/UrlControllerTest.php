<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    /** @test */
    public function will_return_short_url(): void
    {
        $response = $this->post(route("urls.store"), [
            'destination_url' => 'https://google.com'
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function will_throw_validation_error_if_url_is_not_valid(): void
    {
        $response = $this->post(route("urls.store"), [
            'destination_url' => 'www.google.com'
        ]);

        $response->assertSessionHasErrors('destination_url');
        $errors = session('errors');
        $errorMessage = $errors->get('destination_url')[0];

        $response->assertStatus(302);
        $this->assertEquals('The destination url field must be a valid URL.', $errorMessage);
    }

    /** @test */
    public function will_return_same_hash_if_url_is_same(): void
    {
        $response1 = $this->post(route("urls.store"), [
            'destination_url' => 'https://google.com'
        ]);

        $short_url1 = json_decode($response1->getContent())->short_url;

        $response2 = $this->post(route("urls.store"), [
            'destination_url' => 'https://google.com'
        ]);

        $short_url12 = json_decode($response2->getContent())->short_url;

        $this->assertEquals($short_url1, $short_url12);
    }
}
