<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('gmch_pmjay_ha');

        $users = 
        array(
        	['username' => '9954972345', 'name' => 'Nandini Hazarika Bharali', 'password' => $password
        	],

        	['username' => '8638330536', 'name' => 'Mrinal Patowary', 'password' => $password
        	],

        	['username' => '9508488115', 'name' => 'Sanjib Kr Thakur', 'password' => $password
        	],

        	['username' => '8617658668', 'name' => 'Gyaneswari Acharya', 'password' => $password
        	],

        	['username' => '6001723416', 'name' => 'Rima Rajbanshi', 'password' => $password
        	],

        	['username' => '8812874419', 'name' => 'Bangshi Gopal Sarma', 'password' => $password
        	],
        );

        DB::table('users')->insert($users);
    }
}
