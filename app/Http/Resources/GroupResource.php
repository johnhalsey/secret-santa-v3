<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'members'    => MemberResource::collection($this->members),
            'exceptions' => ExceptionResource::collection($this->exceptions),
            'drawn_at'   => $this->drawn_at ? $this->drawn_at->format('jS F Y') : false
        ];
    }
}
