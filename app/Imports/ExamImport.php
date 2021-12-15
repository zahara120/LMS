<?php

namespace App\Imports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\ToModel;

class ExamImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Exam([
            'category_trainings_id'     => $row[1],
            'subcategory_trainings_id'     => $row[2],
            'lesson_id'     => $row[3],
            'nameTest'     => $row[4],
            'typeTest'     => $row[5],
            'start_date'     => $row[6],
            'end_date'     => $row[7],
            'duration'     => $row[8],
            'description'     => $row[9],
        ]);
    }
}
