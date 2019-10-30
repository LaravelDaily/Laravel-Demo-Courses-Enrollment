<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::searchResults()
            ->paginate(6);

        $breadcrumb = "Courses";

        return view('courses.index', compact(['courses', 'breadcrumb']));
    }

    public function show(Course $course)
    {
        $course->load('institution');
        $breadcrumb = $course->name;

        return view('courses.show', compact(['course', 'breadcrumb']));
    }
}
