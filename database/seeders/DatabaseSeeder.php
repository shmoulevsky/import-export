<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $maxCount = 100;
        $token = Str::random(10);
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        for($i=0; $i < $maxCount;$i++){
            $users[] = [
                    'user_name' => fake()->name(),
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'patronymic' => fake()->firstName(),
                    'email' => fake()->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => $password,
                    'remember_token' => $token
            ];
        }

        DB::table('users')->insert($users);

    }
}
