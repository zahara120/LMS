<?php

namespace App\Imports;

use App\Models\Venue;
use Maatwebsite\Excel\Concerns\ToModel;

class VenueImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Venue([
            'nameVenue' => $row[1]
        ]);
    }
}
