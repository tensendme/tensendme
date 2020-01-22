{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="name"
               value="{{$country ? $country->name : old('name')}}"
               placeholder="Наименование"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название страны</label>
    </div>
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="phone_prefix"
               value="{{$country->phone_prefix ? $country->phone_prefix : old('phone_prefix')}}"
               placeholder="Префикс"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите префикс номера телефона</label>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
