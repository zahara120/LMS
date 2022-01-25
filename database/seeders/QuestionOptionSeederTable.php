<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionOptionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_options')->insert([
            [
                'question_id' => 1,
                'test_id' => 1,
                'option_text' => 'Exercitationem simil',
                'correct' => 1
            ],
            [
                'question_id' => 1,
                'test_id' => 1,
                'option_text' => 'Laudantium laboris',
                'correct' => 0
            ],
            [
                'question_id' => 2,
                'test_id' => 1,
                'option_text' => 'Tempora atque et acc',
                'correct' => 1
            ],
            [
                'question_id' => 2,
                'test_id' => 1,
                'option_text' => 'Quis eu ad saepe exe',
                'correct' => 0
            ],
        ]);
    }
}
