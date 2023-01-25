<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_export_php()
    {
        $response = $this->post('/api/export', ['type' => 'php']);
        $response->assertStatus(200);
    }

    public function test_export_laravel_excel()
    {
        $response = $this->post('/api/export', ['type' => 'laravel-excel']);
        $response->assertStatus(200);
    }

    public function test_export_laravel_spatie()
    {
        $response = $this->post('/api/export', ['type' => 'spatie-excel']);
        $response->assertStatus(200);
    }

}
