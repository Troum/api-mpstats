<?php

namespace App\Services;

use App\Classes\ConvertedRequest;
use App\Classes\ConvertedResponse;
use App\Exports\CategoriesExport;
use App\Models\Export;
use Closure;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class HelperService
{
    /**
     * @param Request $request
     * @return ConvertedRequest
     */
    final public static function convertRequest(Request $request): ConvertedRequest
    {
        $queryString = $request->getQueryString();
        $data = Arr::except($request->validated() ?? [], array_keys($request->query()));

        return new ConvertedRequest($queryString, $data);

    }

    final public static function convertResponse(Response|stdClass $response): ConvertedResponse
    {
        return match (true) {
            $response instanceof stdClass => new ConvertedResponse(['data' => $response]),
            default => new ConvertedResponse($response->json()),
        };
    }

    /**
     * @param object $categories
     * @param string $service
     * @return void
     */
    private static function putCategoriesIntoCache(object $categories, string $service): void
    {
        Cache::put("$service.categories", $categories);
    }

    /**
     * @param string $service
     * @param Closure $closure
     * @return mixed|null
     */
    final public static function getCategoriesFromCache(string $service, Closure $closure): mixed
    {
        ini_set('memory_limit', '1024M');

        if (Cache::has("$service.categories")) {
            return Cache::get("$service.categories");
        }

        try {
            $response = call_user_func($closure);
            $result = self::convertResponse($response);

            self::putCategoriesIntoCache($result, $service);

            return $result;
        } catch (\Exception $exception) {

            $result = json_decode(Storage::get("/services/$service.json"));
            $result = self::convertResponse($result);

            self::putCategoriesIntoCache($result, $service);

            return $result;
        }
    }

    /**
     * @param $collection
     * @param string $service
     * @return string|null
     */
    final public static function exportToExcel($collection, string $service): ?string
    {
        if ($collection->isEmpty()) {
            return null;
        }

        $fileName = "$service-categories_" . now()->format('d-m-Y-H-i-s') . '.xlsx';
        Excel::store(new CategoriesExport($collection), 'public/' . $fileName);

        $url = Storage::url($fileName);

        $latest = Export::count();
        $latest = $latest > 0 ? $latest : 1;


        Export::create([
            'file_name' => "Экспорт № $latest" ,
            'service' => $service,
            'url' => $url
        ]);

        return $url;
    }
}
