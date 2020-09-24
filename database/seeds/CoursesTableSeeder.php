<?php

use App\Course;
use App\Discipline;
use App\Institution;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $courses = [
            [
                'name' => 'Web Development',
                'description' => $faker->paragraph,
                'institution_id' => 1,
                'price' => 130
            ],
            [
                'name' => 'Web UX/UI Design',
                'description' => $faker->paragraph,
                'institution_id' => 2,
                'price' => null
            ],
            [
                'name' => 'Wordpress Development',
                'description' => $faker->paragraph,
                'institution_id' => 3,
                'price' => 160
            ],
        ];

        foreach($courses as $id=>$courses)
        {
            $id++;
            $course = Course::create($courses);
            $course->addMedia(public_path("img/course/course_$id.png"))->preservingOriginal()->toMediaCollection('photo');
            $course->disciplines()->sync([$id]);
        }
    }
}
