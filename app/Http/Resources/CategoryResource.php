<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    private $message;

    public function __construct($resource, $message)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        $this->message = $message;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' =>[
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description
            ],
            'meta' => [
                'message' => $this->message,
                'pagination' => (object)[],
            ],
        ];
    }
}
