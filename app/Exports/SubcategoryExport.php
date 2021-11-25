<?php

namespace App\Exports;

use App\Models\SubcategoryTraining;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubcategoryExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return SubcategoryTraining::all();
    }

    public function map($subcategory): array
    {
        return [
            $subcategory->nameSubcategory,
            $subcategory->category->nameCategory,
            $subcategory->description,
        ];

    }

    public function headings(): array{
        return [
            'NAME SUBCATEGORY',
            'NAME CATEGORY',
            'DESCRIPTION',
            
        ];
    }

}