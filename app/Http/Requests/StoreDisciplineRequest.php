<?php

namespace App\Http\Requests;

use App\Discipline;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDisciplineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('discipline_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:disciplines',
            ],
        ];
    }
}
