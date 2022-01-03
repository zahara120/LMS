<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            [
                //zahara
                'user_id'             => 3,
                'role_id'           => 1
            ],
            [
                //naura
                'user_id'             => 1,
                'role_id'           => 1
            ],
            [
                //aitisen
                'user_id'             => 2,
                'role_id'           => 1
            ]
        ]
        );
    }
}
