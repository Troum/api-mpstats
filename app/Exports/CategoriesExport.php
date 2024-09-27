<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoriesExport implements FromCollection, WithMapping, WithHeadings
{
    protected mixed $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return collect($this->categories);
    }

    /**
     * Map the data for specific columns
     *
     * @param mixed $row
     * @return array
     */
    public function map(mixed $row): array
    {
        return [
            'id' => $row['id'],
            'name' => $row['name'],
            'brand' => $row['brand'],
            'rating' => $row['rating'],
            'final_price' => $row['final_price'],
            'final_price_max' => $row['final_price_max'],
            'final_price_average' => $row['final_price_average'],
            'final_price_median' => $row['final_price_median'],
            'basic_sale' => $row['basic_sale'],
            'basic_price' => $row['basic_price'],
            'sales' => $row['sales'],
            'sales_per_day_average' => $row['sales_per_day_average'],
            'revenue' => $row['revenue'],
            'revenue_potential' => $row['revenue_potential'],
            'revenue_average' => $row['revenue_average'],
            'days_in_stock' => $row['days_in_stock'],
            'days_with_sales' => $row['days_with_sales'],
            'is_fbs' => $row['is_fbs'],
            'turnover_days' => $row['turnover_days']
        ];
    }

    /**
     * Define headings for the columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Название',
            'Бренд',
            'Рейтинг',
            'Финальная цена',
            'Максимальная финальная цена',
            'Средняя финальная цена',
            'Медианная финальная цена',
            'Базовая скидка',
            'Базовая цена',
            'Продажи',
            'Средние продажи в день',
            'Выручка',
            'Потенциальная выручка',
            'Средняя выручка',
            'Дни в наличии',
            'Дни с продажами',
            'FBS',
            'Дни оборота',
        ];
    }
}
