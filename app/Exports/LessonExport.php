<?php

namespace App\Exports;

use App\Models\Lesson;
use Maatwebsite\Excel\Concerns\FromCollection;

class LessonExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lesson::all();
    }
}