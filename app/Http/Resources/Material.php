<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Material extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'note' => $this->note,
            'image_path' => $this->image_path,
        ];
    }
}