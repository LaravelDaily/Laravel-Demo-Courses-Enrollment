<?php

namespace App\Http\Controllers\Admin;

use App\Discipline;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDisciplineRequest;
use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisciplinesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('discipline_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplines = Discipline::all();

        return view('admin.disciplines.index', compact('disciplines'));
    }

    public function create()
    {
        abort_if(Gate::denies('discipline_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disciplines.create');
    }

    public function store(StoreDisciplineRequest $request)
    {
        $discipline = Discipline::create($request->all());

        return redirect()->route('admin.disciplines.index');
    }

    public function edit(Discipline $discipline)
    {
        abort_if(Gate::denies('discipline_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disciplines.edit', compact('discipline'));
    }

    public function update(UpdateDisciplineRequest $request, Discipline $discipline)
    {
        $discipline->update($request->all());

        return redirect()->route('admin.disciplines.index');
    }

    public function show(Discipline $discipline)
    {
        abort_if(Gate::denies('discipline_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disciplines.show', compact('discipline'));
    }

    public function destroy(Discipline $discipline)
    {
        abort_if(Gate::denies('discipline_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $discipline->delete();

        return back();
    }

    public function massDestroy(MassDestroyDisciplineRequest $request)
    {
        Discipline::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
