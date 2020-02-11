{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="title"
               value="{{$course ? $course->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название курса</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Краткое описание курса"
                  id="description"
                  required>{{$course ? $course->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание курса</label>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option {{$course->category_id == $category->id ? ' selected ': ''}}
                            value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="category_id">Пожалуйста выберите категорию</label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-11">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               accept="image/*"
               placeholder="Фото"
               required>
        <label class="form-control-plaintext" for="file">Пожалуйста выберите фото</label>
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
