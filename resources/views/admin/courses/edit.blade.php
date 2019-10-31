@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.courses.update", [$course->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.course.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($course) ? $course->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                <label for="photo">{{ trans('cruds.course.fields.photo') }}</label>
                <div class="needsclick dropzone" id="photo-dropzone">

                </div>
                @if($errors->has('photo'))
                    <em class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.photo_helper') }}
                </p>
            </div>
            @if(auth()->user()->isInstitution())
                <input type="hidden" name="institution_id" value="{{ auth()->user()->institution_id }}">
            @else
                <div class="form-group {{ $errors->has('institution_id') ? 'has-error' : '' }}">
                    <label for="institution">{{ trans('cruds.course.fields.institution') }}*</label>
                    <select name="institution_id" id="institution" class="form-control select2" required>
                        @foreach($institutions as $id => $institution)
                            <option value="{{ $id }}" {{ (isset($course) && $course->institution ? $course->institution->id : old('institution_id')) == $id ? 'selected' : '' }}>{{ $institution }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('institution_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('institution_id') }}
                        </em>
                    @endif
                </div>
            @endif
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('cruds.course.fields.price') }}</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($course) ? $course->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.price_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('disciplines') ? 'has-error' : '' }}">
                <label for="disciplines">{{ trans('cruds.course.fields.disciplines') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="disciplines[]" id="disciplines" class="form-control select2" multiple="multiple">
                    @foreach($disciplines as $id => $disciplines)
                        <option value="{{ $id }}" {{ (in_array($id, old('disciplines', [])) || isset($course) && $course->disciplines->contains($id)) ? 'selected' : '' }}>{{ $disciplines }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplines'))
                    <em class="invalid-feedback">
                        {{ $errors->first('disciplines') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.disciplines_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.courses.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($course) && $course->photo)
      var file = {!! json_encode($course->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $course->photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop