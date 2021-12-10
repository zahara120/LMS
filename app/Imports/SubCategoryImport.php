<?php

namespace App\Imports;

use App\Models\SubcategoryTraining;
use Maatwebsite\Excel\Concerns\ToModel;

class SubCategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubcategoryTraining([
            'category_trainings_id'     => $row[1],
            'nameSubcategory'     => $row[2],
            'description'     => $row[3],
        ]);
    }
}
