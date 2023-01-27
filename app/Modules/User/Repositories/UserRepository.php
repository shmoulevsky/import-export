<?php

namespace App\Modules\User\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function all($sort = 'id', $dir = 'desc', $count = 10)
    {
        return DB::table('users')
            ->select(
                'users.*',
            )
            ->orderBy($sort, $dir)
            ->paginate($count);
    }
}
