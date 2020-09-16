<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // set image URI (a default image is set if the resource does not have an image)
        $exists = Storage::exists($this->image_path);
        $imageUri =  env('APP_URL') . '/' . ($exists ? $this->image_path : Controller::NO_IMAGE_PATH);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_path' => $this->image_path,
            'image_URI' => $imageUri,
        ];
    }
}
