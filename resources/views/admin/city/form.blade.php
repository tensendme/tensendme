{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="name"
               value="{{$city ? $city->name : old('name')}}"
               placeholder="Наименование"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название города</label>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="country_id" id="country_id" required>
                @foreach($countries as $country)
                    <option {{$city->country_id == $country->id ? ' selected ': ''}}
                            value="{{$country->id}}">
                        {{$country->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="country_id">Пожалуйста выберите страну</label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
