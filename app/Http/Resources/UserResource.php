<?php

namespace App\Http\Resources;

use App\User;
use App\UserJob;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var User */
        $user = Auth::user();
        $userJob = UserJob::find($this->user_job_id);

        if ($user->isAdmin())
            return parent::toArray($request);

        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'job' => $userJob->name ?? null,
        ];
    }
}
