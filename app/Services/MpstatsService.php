<?php

namespace App\Services;

use App\Enums\ServicesEnum;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Collections\CategoryCollection;
use App\Http\Resources\Collections\ResultCollection;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

final readonly class MpstatsService
{
    private mixed $http;

    public function __construct()
    {
        $this->http = Http::baseUrl(config('services.mpstats.url'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'X-Mpstats-TOKEN' => config('services.mpstats.token'),
            ]);
    }

    /**
     * @param CategoriesRequest $request
     * @return array|false|string
     */
    public function getCategories(CategoriesRequest $request): array|false|string
    {
        return match ($request->validated('service')) {
            ServicesEnum::WB->value => $this->getWbCategories(),
            ServicesEnum::OZ->value => $this->getOzCategories(),
            ServicesEnum::YM->value => $this->getYmCategories(),
            default => json_encode([]),
        };
    }

    /**
     * @param CategoryRequest $request
     * @return array|false|string
     * @throws ConnectionException
     */
    public function getCategory(CategoryRequest $request): array|false|string
    {
        $convertedData = HelperService::convertRequest($request);

        return match ($request->validated('service')) {
            ServicesEnum::WB->value => $this->getWbCategory($convertedData->queryString, $convertedData->data),
            ServicesEnum::OZ->value => $this->getOzCategory($convertedData->queryString, $convertedData->data),
            ServicesEnum::YM->value => $this->getYmCategory($convertedData->queryString, $convertedData->data),
            default => json_encode([]),
        };
    }

    /**
     * @return array
     */
    private function getWbCategories(): array
    {
        $result = HelperService::getCategoriesFromCache('wb', fn () => $this->http->get('/wb/get/categories'));

        return [
            'categories' => new CategoryCollection($result->data)
        ];
    }

    /**
     * @throws ConnectionException
     */
    private function getWbCategory(string $queryString, array $data): array
    {
        $response = $this->http->post('/wb/get/category?' . $queryString, $data);
        $result = HelperService::convertResponse($response);

        $collection = new ResultCollection($result->data);
        $fileUrl = HelperService::exportToExcel($collection, 'wb');

        return [
            'category' => $collection,
            'url' => $fileUrl ? url($fileUrl) : null
        ];
    }

    /**
     * @return array
     */
    private function getOzCategories(): array
    {
        $result = HelperService::getCategoriesFromCache('oz', fn () => $this->http->get('/oz/get/categories'));

        return [
            'categories' => new CategoryCollection($result->data)
        ];
    }

    /**
     * @throws ConnectionException
     */
    private function getOzCategory(string $queryString, array $data): array
    {
        $response = $this->http->post('/oz/get/category?' . $queryString, $data);
        $result = HelperService::convertResponse($response);

        $collection = new ResultCollection($result->data);
        $fileUrl = HelperService::exportToExcel($collection, 'oz');

        return [
            'category' => $collection,
            'url' => $fileUrl ? url($fileUrl) : null
        ];
    }

    /**
     * @return string[]
     */
    private function getYmCategories(): array
    {
        $result = HelperService::getCategoriesFromCache('ym', fn () => $this->http->get('/oz/get/categories'));
        return [
            'categories' => new CategoryCollection($result->data)
        ];
    }

    /**
     * @throws ConnectionException
     */
    private function getYmCategory(string $queryString, array $data): array
    {
        $response = $this->http->post('/ym/get/category?' . $queryString, $data);
        $result = HelperService::convertResponse($response);

        $collection = new ResultCollection($result->data);
        $fileUrl = HelperService::exportToExcel($collection, 'ym');

        return [
            'category' => $collection,
            'url' => $fileUrl ? url($fileUrl) : null
        ];
    }
}
