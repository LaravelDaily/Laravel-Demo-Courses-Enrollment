<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Admin\CourseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['institution', 'disciplines'])->get());
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->disciplines()->sync($request->input('disciplines', []));

        if ($request->input('photo', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['institution', 'disciplines']));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->disciplines()->sync($request->input('disciplines', []));

        if ($request->input('photo', false)) {
            if (!$course->photo || $request->input('photo') !== $course->photo->file_name) {
                $course->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($course->photo) {
            $course->photo->delete();
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
