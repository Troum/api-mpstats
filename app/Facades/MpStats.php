<?php

namespace App\Facades;

use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoryRequest;
use App\Services\MpstatsService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getCategories(CategoriesRequest $request)
 * @method static array getCategory(CategoryRequest $request)
 */
class MpStats extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MpStatsService::class;
    }
}
