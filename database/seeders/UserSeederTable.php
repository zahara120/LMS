<?php
namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeederTable extends Seeder
{
    public function run()
    {

        DB::table('users')->insert([
            [
                'id'             => 1,
                'name'           => 'Naura Gena',
                'nip'          => 'mb21-002',
                'password'       => '$2y$10$he9HNjWJponZR0rYOYQdhefd0uRNVQwg0NRkLU8GbYUcYgr0acERi',
                'two_factor_secret'        => '',
                'two_factor_recovery_codes' => '',
                'remember_token' => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Aitisen',
                'nip'          => 'mb21-001',
                'password'       => '2y$10$Vu26mDzIjNsJkKD924xnSObJcYnaPtC9dweV5BY6bLn/pnYlIgcx2',
                'two_factor_secret'        => '',
                'two_factor_recovery_codes' => '',
                'remember_token' => '',
            ],
            [
                'id'             => 3,
                'name'           => 'zahara',
                'nip'          => 'admin@admin.com',
                'password'       => '12345678',
                'two_factor_secret'        => '',
                'two_factor_recovery_codes' => '',
                'remember_token' => '',
            ],
        ]
        );
    }
}