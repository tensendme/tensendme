{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="name"
               value="{{$marketingMaterial ? $marketingMaterial->name : old('name')}}"
               placeholder="Наименование"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название</label>
    </div>
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="url"
               value="{{$marketingMaterial->url ? $marketingMaterial->url : old('url')}}"
               placeholder="Ссылка"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите ссылку</label>
    </div>
    <div class="form-group col-md-11">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               accept="image/*"
               placeholder="Фото"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста выберите фоновое фото</label>
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
