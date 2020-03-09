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
    <div class="form-group col-md-3">
        <input type="number" class="form-control"
               name="start_count"
               min="0"
               value="{{$level ? $level->start_count : old('start_count')}}"
               placeholder="Старт"
               id="start_сount"
               required>
        <label class="form-control-plaintext" for="start_сount">Пожалуйста введите начальное значение уровня</label>
    </div>
    <div class="form-group col-md-3">
        <input type="number" class="form-control"
               name="end_count"
               min="1"
               value="{{$level ? $level->end_count : old('end_count')}}"
               placeholder="Финиш"
               id="end_count"
               required>
        <label class="form-control-plaintext" for="end_count">Пожалуйста введите конченое значение уровня</label>
    </div>
    <div class="form-group col-md-3">
        <input type="number" class="form-control"
               name="discount_percentage"
               min="1"
               value="{{$level ? $level->discount_percentage : old('discount_percentage')}}"
               placeholder="Процент скидки"
               id="discount_percentage"
               required>
        <label class="form-control-plaintext" for="discount_percentage">Пожалуйста введите  процент скидки уровня</label>
    </div>
    <div class="form-group col-md-3">
        <input type="number" class="form-control"
               name="period_date"
               min="1"
               value="{{$level ? $level->period_date : old('period_date')}}"
               placeholder="Срок уровня"
               id="period_date"
               required>
        <label class="form-control-plaintext" for="period_date">Пожалуйста введите срок уровня в днях</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-5">
        <input type="file"
               id="logo"
               class="form-control"
               name="logo"
               accept="image/*"
               placeholder="Фото">
        <label class="form-control-plaintext" for="logo">Пожалуйста добавьте логотип уровня</label>
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
    <div class="form-group col-md-6">
        <textarea type="text" class="form-control"
                  name="description"
                  placeholder="Описание уровня"
                  id="description"
                  rows="8"
                  required>{{$level ? $level->description : old('description')}}</textarea>
        <label class="form-control-plaintext" for="description">Пожалуйста введите описание уровня</label>
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
            document.getElementById('logo').disabled = !el.checked;
        }
    </script>
@endsection
@include('admin.layouts.parts.error')
