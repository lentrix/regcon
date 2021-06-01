<?php

use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<50; $i++) {
            \App\Participant::create([
                'convention_id' => 1,
                'user_id' => $i,
                'role' => 'participant',
                'accepted_by' => 'migration'
            ]);
        }
    }
}
