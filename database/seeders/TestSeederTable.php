<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
        [
            'category_trainings_id' => 3,
            'subcategory_trainings_id' => 2,
            'lesson_id' => 2,
            'nameTest' => 'dummy',
            'typeTest' => 'PostTest',
            'start_date' => '2022-01-21 06:28:00',
            'end_date' => '2022-01-31 16:39:00',
            'duration' => '10 Days :10:11:00',
            'description' => 'Dignissimos repellen'
        ],
        [
            'category_trainings_id' => 1,
            'subcategory_trainings_id' => 4,
            'lesson_id' => 2,
            'nameTest' => 'dummy 2',
            'typeTest' => 'PreTest',
            'start_date' => '2022-01-21 06:28:00',
            'end_date' => '2022-01-31 16:39:00',
            'duration' => '10 Days :10:11:00',
            'description' => 'Dignissimos repellen'
        ],
        ]);
    }
}
