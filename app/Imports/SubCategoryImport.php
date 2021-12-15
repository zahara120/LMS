<?php

namespace App\Imports;

use App\Models\SubcategoryTraining;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class SubCategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubcategoryTraining([
            'category_trainings_id'     => $row['Category Training ID'],
            'nameSubcategory'     => $row['Subcategory Name'],
            'description'     => $row['Description'],
        ]);
    }
}
