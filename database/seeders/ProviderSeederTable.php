<?php
namespace Database\Seeders;

use App\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeederTable extends Seeder
{
    public function run()
    {

        DB::table('providers')->insert([
            [
                'id'             => 1,
                'nameProvider'   => 'PT. Gajah Tunggal',
                'typeProvider'   => 'Internal',
            ],
            [
                'id'             => 2,
                'nameProvider'   => 'CV. Expertindo Training',
                'typeProvider'   => 'External',
            ],
            [
                'id'             => 3,
                'nameProvider'   => 'PT. Indo Training',
                'typeProvider'   => 'External',
            ],
            [
                'id'             => 4,
                'nameProvider'   => 'PT. Global Training Center',
                'typeProvider'   => 'External',
            ],
        ]
        );
    }
}