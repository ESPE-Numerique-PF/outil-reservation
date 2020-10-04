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
        $imageUri =  config('app.url') . '/' . ($exists ? $this->image_path : Controller::NO_IMAGE_PATH);

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'material_instances_count'=> count($this->materialInstances),
            'note'=> $this->note,
            'category_id'=> $this->category_id,
            'image_path'=> $this->image_path,
            'image_URI' => $imageUri,
        ];
    }
}
