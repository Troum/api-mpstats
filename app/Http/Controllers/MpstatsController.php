<?php

namespace App\Http\Controllers;

use App\Facades\MpStats;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Export;
use Illuminate\Http\JsonResponse;
use Throwable;

class MpstatsController extends Controller
{
    /**
     * @param CategoriesRequest $request
     * @return JsonResponse
     */
    public function getCategories(CategoriesRequest $request): JsonResponse
    {
        try {
            $result = MpStats::getCategories($request);
            return $this->success($result);
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function getCategory(CategoryRequest $request): JsonResponse
    {
        try {
            $result = MpStats::getCategory($request);
            return $this->success($result);
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function getFiles(): JsonResponse
    {
        try {
            $result = ['files' => Export::select(['file_name', 'url', 'service', 'created_at'])->get()];
            return $this->success($result);
        } catch (Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
