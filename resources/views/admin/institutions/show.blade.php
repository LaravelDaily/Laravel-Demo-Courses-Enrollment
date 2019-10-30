@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.institution.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.institution.fields.id') }}
                        </th>
                        <td>
                            {{ $institution->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institution.fields.name') }}
                        </th>
                        <td>
                            {{ $institution->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institution.fields.description') }}
                        </th>
                        <td>
                            {!! $institution->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institution.fields.logo') }}
                        </th>
                        <td>
                            @if($institution->logo)
                                <a href="{{ $institution->logo->getUrl() }}" target="_blank">
                                    <img src="{{ $institution->logo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection