<?php

namespace App\Http\Resources;

use App\UserJob;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class User extends JsonResource
{
    /**
     * If authentified user is admin, get all users information.
     * Else, show only public information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
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
