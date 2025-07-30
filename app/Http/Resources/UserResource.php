<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'approval_status' => $this->approval_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'approved_at' => $this->approved_at,
            'approved_by' => $this->approved_by,
            'rejection_reason' => $this->rejection_reason,
        ];
    }
}
