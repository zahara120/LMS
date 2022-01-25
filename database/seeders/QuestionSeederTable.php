<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'test_id' => 1,
                'question' => 'Nulla minim ut liber',
                'score' => 1
            ],
            [
                'test_id' => 1,
                'question' => 'Nihil aut tempore m',
                'score' => 1
            ],
            [
                'test_id' => 2,
                'question' => 'Est voluptas libero',
                'score' => 1
            ],
            [
                'test_id' => 2,
                'question' => 'Tempor incidunt nul',
                'score' => 1
            ],
        ]);
    }
}
