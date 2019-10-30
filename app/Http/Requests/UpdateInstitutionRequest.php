<?php

namespace App\Http\Requests;

use App\Institution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateInstitutionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('institution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:institutions,name,' . request()->route('institution')->id,
            ],
        ];
    }
}
