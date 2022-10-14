<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        User::factory(150)->create();

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

        User::create([
            'firstname' => 'Foo',
            'lastname' => 'Bar',
            'middleinitial' => 'B',
            'student_no' => '20182-00000-MN-0',
            'section' => 'BSIT-1A',
            'username' => 'prof',
            'password' => bcrypt('prof'),
            'role' => 'professor',
            'token' => Str::random(20)
        ]);
    }
}
