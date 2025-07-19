<?php
if (!function_exists('getPaginationInfo')) {
    function getPaginationInfo($data)
    {
        return [
            'currentPage' => $data->currentPage(),
            'lastPage' => $data->lastPage(),
            'from' => $data->firstItem() ?? 0,
            'to' => $data->lastItem() ?? 0,
            'total' => $data->total(),
            'perPage' => $data->perPage() ?? 15,
            'previousPageUrl' => $data->previousPageUrl() ?? null,
            'nextPageUrl' => $data->nextPageUrl() ?? null,
            'hasPreviousPage' => $data->currentPage() > 1,
            'hasNextPage' => $data->hasMorePages(),
        ];
    }
}
