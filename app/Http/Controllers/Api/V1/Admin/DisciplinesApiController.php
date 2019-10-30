<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Discipline;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use App\Http\Resources\Admin\DisciplineResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisciplinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('discipline_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisciplineResource(Discipline::all());
    }

    public function store(StoreDisciplineRequest $request)
    {
        $discipline = Discipline::create($request->all());

        return (new DisciplineResource($discipline))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Discipline $discipline)
    {
        abort_if(Gate::denies('discipline_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisciplineResource($discipline);
    }

    public function update(UpdateDisciplineRequest $request, Discipline $discipline)
    {
        $discipline->update($request->all());

        return (new DisciplineResource($discipline))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Discipline $discipline)
    {
        abort_if(Gate::denies('discipline_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $discipline->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
