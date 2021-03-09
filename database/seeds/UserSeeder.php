<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $user = [
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
        ];

        User::create($user);

        factory(User::class, 50)->create();
    }
}
