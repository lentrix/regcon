<?php

use Illuminate\Database\Seeder;

class ConventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Convention::create([
            'title' => '16th PSITE-7 Regional Convention',
            'host_school' => 'Mater Dei College',
            'chairman' => 'Mr. Benjie B. Lenteria',
            'venue' => 'Via Zoom Teleconferencing',
            'schedule' => 'June 15-18, 2021',
            'theme' => 'Disrupting a Pandemic-Ridden Community Through Information Technology'
        ]);
    }
}
