<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Enrollment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Http\Resources\Admin\EnrollmentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnrollmentResource(Enrollment::with(['user', 'course'])->get());
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = Enrollment::create($request->all());

        return (new EnrollmentResource($enrollment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnrollmentResource($enrollment->load(['user', 'course']));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->all());

        return (new EnrollmentResource($enrollment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Enrollment $enrollment)
    {
        abort_if(Gate::denies('enrollment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
