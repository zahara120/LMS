<?php
namespace Database\Seeders;

use App\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeederTable extends Seeder
{
    public function run()
    {

        DB::table('venues')->insert([
            [
                'id'             => 1,
                'nameVenue'           => 'POLTEK',
            ],
            [
                'id'             => 2,
                'nameVenue'           => 'GTMO',
            ],
        ]
        );
    }
}