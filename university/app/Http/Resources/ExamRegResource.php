<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\SubjectResource;

class ExamRegResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'exam_registration';

    public function toArray($request)
    {
        return[
            'id' => $this->resource->id,
            'user' => new UserResource($this->resource->user),
            'subject' => new SubjectResource($this->resource->subject),
            'date_of_exam'=> $this->resource->date_of_exam
        ];
    }

   
}
