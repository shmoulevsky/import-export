<?php

namespace App\Modules\Result\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ResultResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'duration' => Carbon::createFromFormat('Y-m-d H:i:s.u', $this->end)->diffInMilliseconds(Carbon::createFromFormat('Y-m-d H:i:s.u', $this->start)),
            'type' => $this->type,
            'route' => $this->route,
            'status' => $this->status,
            'total_count' => $this->total_count,
            'success_count' => $this->success_count,
            'error_count' => $this->error_count,

        ];
    }
}
