<?php

namespace App\Modules\Result\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type,
            'route' => $this->route,
            'status' => $this->status,
            'total_count' => $this->total_count,
            'success_count' => $this->success_count,
            'error_count' => $this->error_count,

        ];
    }
}
