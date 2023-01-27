<?php

namespace Database\Seeders;

use App\Modules\Utils\Services\PasswordRandomService;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $users = [];
        $maxCount = 1000;

        $faker = Factory::create('en_US');
        $passwordRandomService = new PasswordRandomService();

        for($i=0; $i < $maxCount;$i++){

            $password = $passwordRandomService->handle();
            $token = Str::random(10);
            $fio = explode(' ',fake()->name());

            $users[] = [
                    'user_name' => $faker->name(),
                    'first_name' => $fio[1],
                    'last_name' => $fio[0],
                    'patronymic' => $fio[2],
                    'email' => fake()->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => $password,
                    'remember_token' => $token
            ];
        }

        DB::table('users')->insert($users);

    }
}
