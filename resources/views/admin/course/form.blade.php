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
    <div class="form-group col-md-12">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Краткое описание курса"
                  id="description"
                  required>{{$course ? $course->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание курса</label>
    </div>
</div>
<div class="form-row">
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
    <div class="col-md-6">
        <div class="form-group">
            <input class="form-control" type="file" name="image" id="image" accept="image/*">
            <label class="form-control-plaintext" for="image">Пожалуйста выберите фото</label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
