@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.enrollment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.enrollments.update", [$enrollment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if(auth()->user()->isInstitution())
                <input type="hidden" name="user_id" value="{{ (isset($enrollment) && $enrollment->user) ? $enrollment->user->id : '' }}">
            @else
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                    <label for="user">{{ trans('cruds.enrollment.fields.user') }}*</label>
                    <select name="user_id" id="user" class="form-control select2" required>
                        @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ (isset($enrollment) && $enrollment->user ? $enrollment->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('user_id') }}
                        </em>
                    @endif
                </div>
            @endif
            <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
                <label for="course">{{ trans('cruds.enrollment.fields.course') }}*</label>
                <select name="course_id" id="course" class="form-control select2" required>
                    @foreach($courses as $id => $course)
                        <option value="{{ $id }}" {{ (isset($enrollment) && $enrollment->course ? $enrollment->course->id : old('course_id')) == $id ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
                @if($errors->has('course_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('course_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.enrollment.fields.status') }}*</label>
                @foreach(App\Enrollment::STATUS_RADIO as $key => $label)
                    <div>
                        <input id="status_{{ $key }}" name="status" type="radio" value="{{ $key }}" {{ old('status', $enrollment->status) === (string)$key ? 'checked' : '' }} required>
                        <label for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <em class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection