<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListAllBlogCategory extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->transformCollection($this->collection),
            'meta' => [
                'success' => true,
                'message' => 'Success Get Category',
                'pagination' => $this->metaData()
            ]
        ];
    }

    private function transformCollection($collection) {
        return $collection->transform(function ($data) {
            return $this->transformData($data);
        });
    }

    private function transformData($data) {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'description' => $data->description
        ];
    }

    private function metaData() {
        return [
            'total' => $this->count(),
            'currentPage' => $this->currentPage(),
            'totalPage' => $this->lastPage()
        ];
    }
}
