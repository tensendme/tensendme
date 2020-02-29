{{csrf_field()}}
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <select class="form-control" name="type_id" id="type_id">
                @foreach($subscriptionTypes as $type)
                    <option value="{{$type->id}}">
                        {{$type->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="type_id">Пожалуйста выберите тип подписки</label>
        </div>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
