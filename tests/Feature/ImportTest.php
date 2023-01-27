<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Import\Entities\ImportType;
use App\Modules\Import\Factory\ImportServiceFactory;
use App\Modules\Result\Services\ResultService;
use App\Modules\User\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ImportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_import_php()
    {
        $resultService = new ResultService();
        $result = $resultService->add(ImportType::PHP, 'test/api/import');

        $file = 'test.csv';
        $type = ImportType::PHP;
        $modelName = User::class;
        $path = storage_path('app/public/').$file;

        $fields = [
            'user_name' => ['required','max:100','unique:users,user_name'],
            'first_name' => ['required','cyrillic','max:255'],
            'last_name' => ['required','cyrillic','max:255'],
            'patronymic' => ['cyrillic','max:255'],
            'email' => ['required','email'],
            'password' => ['required','password']
        ];

        $model = app()->make($modelName);
        $factory = new ImportServiceFactory();
        $service = $factory->make($type);
        $service->import($path, $fields, $model, $result->id);

        $this->assertTrue(true);
    }

    public function test_import_laravel_spatie()
    {
        $resultService = new ResultService();
        $result = $resultService->add(ImportType::SPATIE_EXCEL, 'test/api/import');

        $file = 'test.csv';
        $type = ImportType::SPATIE_EXCEL;
        $modelName = User::class;
        $path = storage_path('app/public/').$file;

        $fields = [
            'user_name' => ['required','max:100','unique:users,user_name'],
            'first_name' => ['required','cyrillic','max:255'],
            'last_name' => ['required','cyrillic','max:255'],
            'patronymic' => ['cyrillic','max:255'],
            'email' => ['required','email'],
            'password' => ['required','password']
        ];

        $model = app()->make($modelName);
        $factory = new ImportServiceFactory();
        $service = $factory->make($type);
        $service->import($path, $fields, $model, $result->id);

        $this->assertTrue(true);
    }

}
