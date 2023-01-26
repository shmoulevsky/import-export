<?php

namespace App\Modules\Result\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ResultCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => ResultResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
