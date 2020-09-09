<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
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
        $imageUri =  env('APP_URL') . '/' . ($exists ? $this->image_path : 'images/no_image.png');

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'image_path'=> $this->image_path,
            'image_URI' => $imageUri,
        ];
    }
}
