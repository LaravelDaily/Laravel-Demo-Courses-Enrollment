<?php

namespace App\Http\Requests;

use App\Enrollment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('enrollment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id'   => [
                'required',
                'integer',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
            'status'    => [
                'required',
            ],
        ];
    }
}
