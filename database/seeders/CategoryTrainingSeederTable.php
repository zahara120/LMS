<?php
namespace Database\Seeders;

use App\CateyoryTraining;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTrainingSeederTable extends Seeder
{
    public function run()
    {

        DB::table('category_trainings')->insert([
            [
                'id'             => 1,
                'nameCategory'           => 'General',
            ],
            [
                'id'             => 2,
                'nameCategory'           => 'Environment',
            ],
            [
                'id'             => 3,
                'nameCategory'           => 'Engineer',
            ],
            [
                'id'             => 4,
                'nameCategory'           => 'Finance',
            ],
        ]);
    }
}