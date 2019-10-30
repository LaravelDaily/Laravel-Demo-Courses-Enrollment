@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.enrollment.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.id') }}
                        </th>
                        <td>
                            {{ $enrollment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.user') }}
                        </th>
                        <td>
                            {{ $enrollment->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.course') }}
                        </th>
                        <td>
                            {{ $enrollment->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.enrollment.fields.status') }}
                        </th>
                        <td>
                            {{ App\Enrollment::STATUS_RADIO[$enrollment->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection