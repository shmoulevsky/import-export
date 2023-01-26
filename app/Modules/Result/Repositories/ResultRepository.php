<?php

namespace App\Modules\Result\Repositories;

use Illuminate\Support\Facades\DB;

class ResultRepository
{
    public function all()
    {
        return DB::table('results')
            ->select(
                'results.*',
                'result_logs.total_count',
                'result_logs.success_count',
                'result_logs.error_count',
            )
            ->join('result_logs', 'results.id','=','result_logs.result_id')
            ->get();
    }
}
