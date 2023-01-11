<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'HomerSimpson',
                'email' => 'homer@gmail.com',
                'password' => bcrypt('123456'),
                'last_login' => date('Y-m-d H:i:s'),
                'dob' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'PeterGriffen',
                'email' => 'peter@gmail.com',
                'password' => bcrypt('123456'),
                'last_login' => date('Y-m-d H:i:s'),
                'dob' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ryan Higa',
                'email' => 'ryan@gmail.com',
                'password' => bcrypt('123456'),
                'last_login' => date('Y-m-d H:i:s'),
                'dob' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Keanu Reeves',
                'email' => 'keanu@gmail.com',
                'password' => bcrypt('123456'),
                'last_login' => date('Y-m-d H:i:s'),
                'dob' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
