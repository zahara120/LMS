<?php

namespace App\Exports;
use App\Exports\RoomExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Room::all();
    }

    public function map($room): array
    {
        return [
            $room->nameRoom,
            $room->venue->nameVenue,
        ];

    }

    public function headings(): array{
        return [
            'NAME ROOM',
            'NAME VENUE',
            
        ];
    }
}