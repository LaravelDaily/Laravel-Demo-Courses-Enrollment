@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.institution.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.institutions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.institution.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($institution) ? $institution->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.institution.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($institution) ? $institution->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                <label for="logo">{{ trans('cruds.institution.fields.logo') }}</label>
                <div class="needsclick dropzone" id="logo-dropzone">

                </div>
                @if($errors->has('logo'))
                    <em class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.logo_helper') }}
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.institutions.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($institution) && $institution->logo)
      var file = {!! json_encode($institution->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $institution->logo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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