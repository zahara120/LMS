<?php

namespace App\Imports;

use App\Models\Provider;
use Maatwebsite\Excel\Concerns\ToModel;

class ProviderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Provider([
            'nameProvider' => $row[1],
            'typeProvider' => $row[2]
        ]);
    }
}
