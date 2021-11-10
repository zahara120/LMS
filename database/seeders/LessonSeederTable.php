<?php
namespace Database\Seeders;

use App\CateyoryTraining;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeederTable extends Seeder
{
    public function run()
    {

        DB::table('lessons')->insert([
            [
                'id'             => 1,
                'category_id'             => 4,
                'subcategory_id'             => 3,
                'nameLesson'           => 'Audit & Sales Tax',
                'description' => 'Usu ocurreret omittantur concludaturque ad, natum constituto, reque vivendum an per.',
                'file'           => '1634541782.mp4',
                'url'           => 'www.google.com',
            ],
            [
                'id'             => 2,
                'category_id'             => 3,
                'subcategory_id'             => 2,
                'nameLesson'           => 'Basic Electrical',
                'description' => 'Et erant dignissim vel, ei stet oportere intellegam cum.',
                'file'           => '1634541920.mp4',
                'url'           => 'www.zoom.com',
            ],
            [
                'id'             => 3,
                'category_id'             => 4,
                'subcategory_id'             => 3,
                'nameLesson'           => 'Economic Theory',
                'description' => 'Eu adipisci usu, offendit ocurreret, ut legendos voluptatum ullamcorper.',
                'file'           => '1634541782.mp4',
                'url'           => 'www.google.com',
            ],
            [
                'id'             => 4,
                'category_id'             => 1,
                'subcategory_id'             => 4,
                'nameSubcategory'           => 'Management Time',
                'description' => 'Cum eloquentiam intellegebat ut, deleniti voluptua ad quo.',
                'file'           => '1634541920.mp4',
                'url'           => 'Has sonet libris at, libris mediocrem ocurreret, quis forensibus eloquentiam ad sit.',
            ],
        ]
        );
    }
}