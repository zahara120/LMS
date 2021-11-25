<?php

namespace App\Exports;

use App\Models\Venue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VenueExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Venue::all();
    }
    public function map($venue): array
    {
        return [
            $venue->nameVenue,
        ];

    }

    public function headings(): array{
        return [
            'NAME VENUE',

        ]
}