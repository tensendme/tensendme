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
    <div class="col-md-6">
        <div class="form-group">
            <input class="form-control" type="file" name="docs[]" id="docs" accept="application/*" multiple>
            <label class="form-control-plaintext" for="docs">Пожалуйста выберите документы </label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
