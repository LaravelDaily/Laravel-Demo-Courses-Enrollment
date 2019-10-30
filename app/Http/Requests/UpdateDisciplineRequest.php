<?php

namespace App\Http\Requests;

use App\Discipline;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDisciplineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('discipline_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:disciplines,name,' . request()->route('discipline')->id,
            ],
        ];
    }
}
