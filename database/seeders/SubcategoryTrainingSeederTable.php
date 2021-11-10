<?php
namespace Database\Seeders;

use App\CateyoryTraining;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoryTrainingSeederTable extends Seeder
{
    public function run()
    {

        DB::table('subcategory_trainings')->insert([
            [
                'id'             => 1,
                'category_id'             => 1,
                'nameSubcategory'           => 'Leadership',
                'description' => 'Lorem ipsum dolor sit amet, velit docendi sea ad.',
            ],
            [
                'id'             => 2,
                'category_id'             => 3,
                'nameSubcategory'           => 'Electrical',
                'description' => 'Et erant dignissim vel, ei stet oportere intellegam cum.',
            ],
            [
                'id'             => 3,
                'category_id'             => 4,
                'nameSubcategory'           => 'Accounting',
                'description' => 'Eu eam delenit molestie iracundia.',
            ],
            [
                'id'             => 4,
                'category_id'             => 1,
                'nameSubcategory'           => 'Management',
                'description' => 'Cum eloquentiam intellegebat ut, deleniti voluptua ad quo.',
            ],
        ]
        );
    }
}