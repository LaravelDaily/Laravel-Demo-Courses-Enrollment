<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Http\Resources\Admin\InstitutionResource;
use App\Institution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('institution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutionResource(Institution::all());
    }

    public function store(StoreInstitutionRequest $request)
    {
        $institution = Institution::create($request->all());

        if ($request->input('logo', false)) {
            $institution->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return (new InstitutionResource($institution))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Institution $institution)
    {
        abort_if(Gate::denies('institution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutionResource($institution);
    }

    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        $institution->update($request->all());

        if ($request->input('logo', false)) {
            if (!$institution->logo || $request->input('logo') !== $institution->logo->file_name) {
                $institution->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($institution->logo) {
            $institution->logo->delete();
        }

        return (new InstitutionResource($institution))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Institution $institution)
    {
        abort_if(Gate::denies('institution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institution->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
