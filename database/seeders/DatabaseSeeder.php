<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
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
        User::factory(500)->create();

        //seed 10 professors
        User::factory(20)->create([
            'role' => 'professor',
            'password' => bcrypt('123'),
        ]);

        //seed 10 professors approved
        User::factory(20)->create([
            'role' => 'professor',
            'password' => bcrypt('123'),
            'approved' => true,
        ]);

        User::create([
            'firstname' => 'Foo',
            'lastname' => 'Bar',
            'middleinitial' => 'B',
            'student_no' => '2018-00000-MN-0',
            'section' => 'BSIT-1A',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'token' => Str::random(20),
            'approved' => 1,
        ]);
    }
}
