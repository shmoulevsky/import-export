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
            'duration' => $this->duration,
            'type' => $this->type,
            'route' => $this->route,
            'status' => $this->status === 1 ? ['title' => 'Успешно', 'class' => 'bg-success'] : ['title' => 'Ошибка', 'class' => 'bg-danger'],
            'total_count' => $this->total_count,
            'success_count' => $this->success_count,
            'error_count' => $this->error_count,

        ];
    }
}
