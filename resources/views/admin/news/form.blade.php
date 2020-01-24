{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="title"
               value="{{$news ? $news->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название новости</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Краткое описание новости"
                  id="description"
                  required>{{$news ? $news->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание новости</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-11">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               placeholder="Фото"
               accept="image/*"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста выберите фото</label>
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
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@section('scripts')
    <script>
        function toggleImage(el) {
            document.getElementById('file').disabled = !el.checked;
        }
    </script>
@endsection

@include('admin.layouts.parts.error')
