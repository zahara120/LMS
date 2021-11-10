<?php
namespace Database\Seeders;

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeederTable extends Seeder
{
    public function run()
    {

        DB::table('permissions')->insert([
            [
                'id'             => 1,
                'namePermission'           => 'Create',
            ],
            [
                'id'             => 2,
                'namePermission'           => 'Delete',
            ],
            [
                'id'             => 3,
                'namePermission'           => 'Edit',
            ],
            [
                'id'             => 4,
                'namePermission'           => 'View',
            ],
        ]
        );
    }
}