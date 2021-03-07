<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'benjielenteria@yahoo.com',
                'lname' => 'Lenteria',
                'fname' => 'Benjie',
                'designation' => 'Faculty',
                'school' => 'Mater Dei College',
                'phone' => '09173035716',
                'phone' => '09173035716',
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('password123')
            ]
        ];

        foreach($users as $user) {
            \App\User::create($user);
        }
    }
}
