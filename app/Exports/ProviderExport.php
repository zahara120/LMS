<?php

namespace App\Exports;
use App\Exports\ProviderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Provider;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProviderExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Provider::all();
    }

    public function map($provider): array
    {
        return [
            $provider->nameProvider,
            $provider->typeProvider,
        ];

    }

    public function headings(): array{
        return [
            'NAME PROVIDER',
            'TYPE POVIDER',
            
        ];
    }
    
}