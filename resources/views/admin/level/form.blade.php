{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="name"
               value="{{$level ? $level->name : old('name')}}"
               placeholder="Наименование"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название уровня</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="number" class="form-control"
               name="start_count"
               min="0"
               value="{{$level ? $level->start_count : old('start_count')}}"
               placeholder="Старт"
               id="start_сount"
               required>
        <label class="form-control-plaintext" for="start_сount">Пожалуйста введите начальное значение уровня</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="number" class="form-control"
               name="end_count"
               min="1"
               value="{{$level ? $level->end_count : old('end_count')}}"
               placeholder="Финиш"
               id="end_count"
               required>
        <label class="form-control-plaintext" for="end_count">Пожалуйста введите конченое значение уровня</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="number" class="form-control"
               name="discount_percentage"
               min="1"
               value="{{$level ? $level->discount_percentage : old('discount_percentage')}}"
               placeholder="Процент скидки"
               id="discount_percentage"
               required>
        <label class="form-control-plaintext" for="discount_percentage">Пожалуйста введите  процент скидки уровня</label>
    </div>
</div>

<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
