{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="name"
               value="{{$category ? $category->name : old('name')}}"
               placeholder="Наименование"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название категории</label>
    </div>
    <div class="form-group col-md-5">
        <input type="file"
               id="file"
               class="form-control"
               name="logo"
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
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="category_type_id" id="category_type_id" required>
                @foreach($categoryTypes as $categoryType)
                    <option {{$category->category_type_id == $categoryType->id ? ' selected ': ''}}
                            value="{{$categoryType->id}}">
                        {{$categoryType->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="category_type_id">Пожалуйста выберите тип категории</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="parent_category_id" id="parent_category_id">
                <option value="">Выберите родителькую категории</option>
                @foreach($categories as $category)
                    <option {{$category->parent_category_id == $category->id ? ' selected ': ''}}
                            value="{{$category->id}}">
                        {{$category->namde}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="parent_category_id">Пожалуйста выберите родителькую категории</label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
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
