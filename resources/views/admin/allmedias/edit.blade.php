@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.allmedia.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.allmedias.update", [$allmedia->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lien_ressources">{{ trans('cruds.allmedia.fields.lien_ressources') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lien_ressources') ? 'is-invalid' : '' }}" id="lien_ressources-dropzone">
                </div>
                @if($errors->has('lien_ressources'))
                    <span class="text-danger">{{ $errors->first('lien_ressources') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.lien_ressources_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="etiquettes">{{ trans('cruds.allmedia.fields.etiquettes') }}</label>
                <input class="form-control {{ $errors->has('etiquettes') ? 'is-invalid' : '' }}" type="text" name="etiquettes" id="etiquettes" value="{{ old('etiquettes', $allmedia->etiquettes) }}" required>
                @if($errors->has('etiquettes'))
                    <span class="text-danger">{{ $errors->first('etiquettes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.etiquettes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.allmedia.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $allmedia->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.allmedia.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $allmedia->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.objecttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeofmedia_id">{{ trans('cruds.allmedia.fields.typeofmedia') }}</label>
                <select class="form-control select2 {{ $errors->has('typeofmedia') ? 'is-invalid' : '' }}" name="typeofmedia_id" id="typeofmedia_id" required>
                    @foreach($typeofmedia as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeofmedia_id') ? old('typeofmedia_id') : $allmedia->typeofmedia->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeofmedia'))
                    <span class="text-danger">{{ $errors->first('typeofmedia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.typeofmedia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objet">{{ trans('cruds.allmedia.fields.objet') }}</label>
                <input class="form-control {{ $errors->has('objet') ? 'is-invalid' : '' }}" type="text" name="objet" id="objet" value="{{ old('objet', $allmedia->objet) }}" required>
                @if($errors->has('objet'))
                    <span class="text-danger">{{ $errors->first('objet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.allmedia.fields.objet_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.lienRessourcesDropzone = {
    url: '{{ route('admin.allmedias.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="lien_ressources"]').remove()
      $('form').append('<input type="hidden" name="lien_ressources" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="lien_ressources"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($allmedia) && $allmedia->lien_ressources)
      var file = {!! json_encode($allmedia->lien_ressources) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="lien_ressources" value="' + file.file_name + '">')
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
@endsection