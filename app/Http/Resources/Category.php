<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if image not define, set a default image
        $exists = Storage::exists($this->image_path);
        $imageUri = $exists ? env('APP_URL') . '/' . $this->image_path : '';

        return [
            'name'=> $this->name,
            'image_path'=> $this->image_path,
            'image_URI' => $imageUri,
        ];
    }
}
