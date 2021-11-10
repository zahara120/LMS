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
        ]
        );

    //     $user = [
    //     [
    //         'id'             => 1,
    //         'name'           => 'Naura Gena',
    //         'nip'          => 'mb21-002',
    //         'password'       => '$2y$10$GdubO8p..1F4Ic60m0e6Nu3H.0T5k6fhRmd3ozDuqaN.dBD83J9ue',
    //         'two_factor_secret'        => '',
    //         'two_factor_recovery_codes' => '',
    //         'remember_token' => '',
    //     ],
    //     [
    //         'id'             => 2,
    //         'name'           => 'Aitisen',
    //         'nip'          => 'mb21-001',
    //         'password'       => '$2y$10$GdubO8p..1F4Ic60m0e6Nu3H.0T5k6fhRmd3ozDuqaN.dBD83J9ue',
    //         'two_factor_secret'        => '',
    //         'two_factor_recovery_codes' => '',
    //         'remember_token' => '',
    //     ],    
    // ]
    //     DB::table('users')->insert($user);
    }
}