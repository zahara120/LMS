<?php

namespace App\Imports;

use App\Models\CategoryTraining;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryTrainingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryTraining([
            'nameCategory'     => $row[1]
        ]);
    }
}
