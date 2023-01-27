<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => UserResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
