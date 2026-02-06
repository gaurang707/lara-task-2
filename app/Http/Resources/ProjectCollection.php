<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    public $collects = ProjectResource::class;

    public function withResponse($request, $response)
    {
        $paginator = $this->resource;
        $response->setData([
            "data" => $this->collection,
            "links" => [
                "first" => $paginator->url(1),
                "last" => $paginator->url($paginator->lastPage()),
                "prev" => $paginator->previousPageUrl(),
                "next" => $paginator->nextPageUrl(),
            ],
            "meta" => [
                "current_page" => $paginator->currentPage(),
                "from" => $paginator->firstItem(),
                "last_page" => $paginator->lastPage(),
                "path" => $paginator->path(),
                "per_page" => $paginator->perPage(),
                "to" => $paginator->lastItem(),
                "total" => $paginator->total(),
            ]
        ]);
    }
}
