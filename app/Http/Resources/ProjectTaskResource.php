<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "project_id" => $this->project_id,
            "project_name" => $this->project->name,
            "assigned_id" => $this->assigned_id,
            "assignee_name" => $this->assignee->name,
            "assignee_email" => $this->assignee->email,
            "status" => $this->status,
            "created_at" => $this->created_at,
        ];
    }
}
