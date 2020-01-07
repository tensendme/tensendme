{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="name"
               value="{{$category ? $category->name : old('name')}}"
               placeholder="Наименование"
               required>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="category_type_id" required>
                @foreach($categoryTypes as $categoryType)
                    <option {{$category->category_type_id == $categoryType->id ? ' selected ': ''}}
                            value="{{$categoryType->id}}">
                        {{$categoryType->name}}
                    </option>
                @endforeach
            </select>
            <div>Пожалуйста выберите тип категории</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="parent_category_id">
                <option value="">Выберите родителькую категории</option>
                @foreach($categories as $category)
                    <option {{$category->parent_category_id == $category->id ? ' selected ': ''}}
                            value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <div>Пожалуйста выберите родителькую категории</div>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить</button>
</div>


@include('admin.layouts.parts.error')