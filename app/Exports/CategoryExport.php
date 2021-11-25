<?php

namespace App\Exports;

use App\Models\CategoryTraining;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryTraining::all();
    }

    public function map($category): array
    {
        return [
            $category->nameCategory,
        ];

    }

    public function headings(): array{
        return [
            'NAME CATEGORY',
        ];
    }
}
