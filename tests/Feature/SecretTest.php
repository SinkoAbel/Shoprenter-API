<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SecretTest extends TestCase
{
    private string $endpoint = '/api/secret';

    #[Test]
    public function test_store_endpoint_json()
    {
        $response = $this->post(
            $this->endpoint,
            [
                'secret' => 'Very secret Json message.',
                'expire_after_views' => 5,
                'expire_after_minutes' => 2,
            ],
            ['Accept' => 'application/json']
        );

        $response->assertStatus(201);
        $this->assertJson($response->getContent());
        $response->assertJsonStructure([
            'id',
            'secret_text',
            'remaining_views',
            'expires_at',
            'created_at'
        ]);
    }

    #[Test]
    public function test_store_endpoint_xml()
    {
        $response = $this->post(
            $this->endpoint,
            [
                'secret' => 'Very secret Xml message.',
                'expire_after_views' => 5,
                'expire_after_minutes' => 2,
            ],
            ['Accept' => 'application/xml']
        );

        $response->assertStatus(201);

        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml, 'Response is not valid XML');
        libxml_clear_errors();
    }

    #[Test]
    public function test_show_endpoint()
    {
        $response = $this->post(
            $this->endpoint,
            [
                'secret' => 'Very secret Json message.',
                'expire_after_views' => 3,
                'expire_after_minutes' => 2,
            ],
            ['Accept' => 'application/json']
        );

        $responseContent = $response->getContent();
        $data = json_decode($responseContent, true);

        $id = $data['id'];

        $showResponse = $this->get($this->endpoint . '/' . $id);
        $showResponse->assertStatus(200);
    }

    #[Test]
    public function test_expired_secret_by_clicks()
    {
        $response = $this->post(
            $this->endpoint,
            [
                'secret' => 'Very secret Json message.',
                'expire_after_views' => 3,
                'expire_after_minutes' => 2,
            ],
            ['Accept' => 'application/json']
        );

        $responseContent = $response->getContent();
        $data = json_decode($responseContent, true);

        $id = $data['id'];

        for ($i = 0; $i < 4; $i++) {
            $this->get($this->endpoint . '/' . $id);
        }

        $response = $this->get($this->endpoint . '/' . $id);
        $response->assertStatus(404);
    }
}
