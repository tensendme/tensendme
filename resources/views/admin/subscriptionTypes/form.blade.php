{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control"
               name="name"
               value="{{$subscription_type ? $subscription_type->name : old('name')}}"
               placeholder="Наименование"
               id="name"
               required>
        <label class="form-control-plaintext" for="name">Пожалуйста введите название типа подписки</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="number" class="form-control"
               name="price"
               min="1"
               value="{{$subscription_type ? $subscription_type->price : old('price')}}"
               placeholder="Цена"
               id="price"
               required>
        <label class="form-control-plaintext" for="price">Пожалуйста введите Цену типа подписки</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <input type="number" class="form-control"
               min="1"
               name="expired_at"
               value="{{$subscription_type ? $subscription_type->expired_at : old('expired_at')}}"
               placeholder="Срок истечения(дни)"
               id="expired_at"
               required>
        <label class="form-control-plaintext" for="expired_at">Пожалуйста введите срок истечения типа подписки</label>
    </div>
</div>
<div class="form-group col-md-12 text-right">
    <button  class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>


@include('admin.layouts.parts.error')
