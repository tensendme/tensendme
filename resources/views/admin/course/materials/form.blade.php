{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="title"
               value="{{$material ? $material->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название урока</label>
    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="number" class="form-control"
               min="1"
               name="ordering"
               value="{{$material ? $material->ordering : old('ordering')}}"
               id="ordering"
               required>
        <label class="form-control-plaintext" for="ordering">Пожалуйста введите номер урока</label>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input class="form-control" type="file" name="video" id="video" accept="video/*">
            <label class="form-control-plaintext" for="video">Пожалуйста выберите видео материал</label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <input class="form-control" type="file" name="docs[]" id="docs" accept="application/*" multiple>
            <label class="form-control-plaintext" for="docs">Пожалуйста выберите документы </label>
        </div>
    </div>
    <div class="form-group col-md-5">
        <input type="file"
               id="file"
               class="form-control"
               name="preview"
               accept="image/*"
               placeholder="Фото"
               required>
        <label class="form-control-plaintext" for="file">Пожалуйста выберите превью фото</label>
    </div>
    <div class="form-group col-md-1">
        <input type="checkbox"
               data-on="Вкл"
               data-off="Откл"
               onchange="toggleImage(this)"
               checked
               data-toggle="toggle"
               data-size="md">
    </div>
    <div class="form-group col-md-3">
        <input type="checkbox" class="form-control" name="access"
               data-on="Бесплатно"
               data-off="C подпиской"
               data-toggle="toggle"
               data-size="md" id="access"
               value="1" {{$material ? ($material->free ? 'checked' : '') : ''}}>
        <label class="form-control-plaintext" for="access">Пожалуйста выберите тип доступа к уроку (Бесплатно или с подпиской)</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Краткое описание урока"
                  id="description"
                  rows="8"
                  required>{{$material ? $material->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание урока</label>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>
@include('admin.layouts.parts.error')
@section('scripts')
<script>
    function toggleImage(el) {
        document.getElementById('file').disabled = !el.checked;
    }
</script>
@endsection
