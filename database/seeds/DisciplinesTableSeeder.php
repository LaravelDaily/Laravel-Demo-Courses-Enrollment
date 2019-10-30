<?php

use App\Discipline;
use Illuminate\Database\Seeder;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplines = ['Web Development', 'Design', 'Wordpress'];

        foreach($disciplines as $discipline)
            Discipline::create(['name' => $discipline]);
    }
}
