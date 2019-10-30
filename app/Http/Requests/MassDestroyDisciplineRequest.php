<?php

namespace App\Http\Requests;

use App\Discipline;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDisciplineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('discipline_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:disciplines,id',
        ];
    }
}
