<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Export\Entities\ExportType;
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
        $response = $this->post('/api/export', ['type' => ExportType::PHP]);
        $response->assertStatus(200);
    }

    public function test_export_laravel_excel()
    {
        $response = $this->post('/api/export', ['type' => ExportType::LARAVEL_EXCEL]);
        $response->assertStatus(200);
    }

    public function test_export_laravel_spatie()
    {
        $response = $this->post('/api/export', ['type' => ExportType::SPATIE_EXCEL]);
        $response->assertStatus(200);
    }

}
