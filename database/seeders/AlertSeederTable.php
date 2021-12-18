<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alerts')->insert([
            [
                'label' => 'Warning',
                'message' => 'this is message for Warning'
            ],
            [
                'label' => 'Success',
                'message' => 'this is message for Success' 
            ],
            [
                'label' => 'Error',
                'message' => 'this is message for Error'
            ]
        ]);
    }
}
