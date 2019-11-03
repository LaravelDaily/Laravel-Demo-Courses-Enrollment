<?php

use App\User;
use App\Course;
use App\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::pluck('id');
        $user = User::first();
        $statuses = collect(['awaiting', 'accepted', 'rejected']);
        foreach($courses as $course)
            $user->enrollments()->create([
                'course_id' => $course,
                'status' => $statuses->random()
            ]);
    }
}
