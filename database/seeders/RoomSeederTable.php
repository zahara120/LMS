<?php
namespace Database\Seeders;

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeederTable extends Seeder
{
    public function run()
    {

        DB::table('rooms')->insert([
            [
                'id'             => 1,
                'venue_id'       => 2,
                'nameRoom'           => 'GA',
            ],
            [
                'id'             => 2,
                'venue_id'       => 1,
                'nameRoom'           => 'Lab',
            ],
            [
                'id'             => 3,
                'venue_id'       => 2,
                'nameRoom'           => 'HR',
            ],
        ]
        );
    }
}