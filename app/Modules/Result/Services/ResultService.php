<?php

namespace App\Modules\Result\Services;

use App\Modules\Result\Entities\ResultStatus;
use App\Modules\Result\Models\Result;
use App\Modules\Result\Models\ResultLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ResultService
{
    public function add($type, $route)
    {
        $result = new Result();

        DB::transaction(function () use ($type, $route, $result){

            $result->start = Carbon::now()->format('Y-m-d H:i:s.u');
            $result->type = $type;
            $result->route = $route;
            $result->status = ResultStatus::PENDING;
            $result->save();

            $resulLog = new ResultLog();
            $resulLog->total_count = 0;
            $resulLog->success_count = 0;
            $resulLog->error_count = 0;
            $resulLog->result_id = $result->id;
            $resulLog->save();

        });

        return $result;

    }

    public function finishImport($resultId, $totalCount, $successCount, $errorCount, $errors)
    {
        $result = Result::find($resultId);

        DB::transaction(function () use ($result, $totalCount, $successCount, $errorCount, $errors){

            $result->end = Carbon::now()->format('Y-m-d H:i:s.u');
            $result->status = ResultStatus::SUCCESS;

            if($errorCount > 0){
                $result->status = ResultStatus::ERROR;
            }

            $result->save();

            $resulLog = ResultLog::where('result_id', $result->id)->first();
            $resulLog->total_count = $totalCount;
            $resulLog->success_count = $successCount;
            $resulLog->error_count = $errorCount;
            $resulLog->result_id = $result->id;
            $resulLog->save();

        });

        return $result;

    }

    public function finish($resultId)
    {
        $result = Result::find($resultId);
        $result->end = Carbon::now()->format('Y-m-d H:i:s.u');
        $result->status = ResultStatus::SUCCESS;
        $result->duration = Carbon::createFromFormat('Y-m-d H:i:s.u', $result->end)->diffInMilliseconds(Carbon::createFromFormat('Y-m-d H:i:s.u', $result->start));
        $result->save();

        return $result;
    }

}
