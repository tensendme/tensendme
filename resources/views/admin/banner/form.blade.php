{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="title"
               value="{{$banner ? $banner->title : old('title')}}"
               placeholder="Наименование"
               id="title"
               required>
        <label class="form-control-plaintext" for="title">Пожалуйста введите название баннера</label>
    </div>
    <div class="form-group col-md-6">
        <input type="text" class="form-control"
               name="link"
               value="{{$banner ? $banner->link_url : old('link')}}"
               placeholder="Адрес ссылки"
               id="link">
        <label class="form-control-plaintext" for="link">Пожалуйста введите ссылку</label>
    </div>
</div>


<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="location_id" id="location_id">
                @foreach($locations as $location)
                    <option {{$banner->location_id == $location->id ? ' selected ': ''}}
                            value="{{$location->id}}">
                        {{$location->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="news_id">Пожалуйста выберите локацию</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control" name="news_id" id="news_id">
                @foreach($news as $n)
                    <option {{$banner->news_id == $n->id ? ' selected ': ''}}
                            value="{{$n->id}}">
                        {{$n->title}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="news_id_id">Пожалуйста выберите новость</label>
        </div>
    </div>
    <div class="form-group col-md-11">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               placeholder="Фото"
               accept="image/*"
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
    <div class="col-md-12">
        <div class="form-group text-left">
            <label>Показ оплаты в мобильном приложении:</label>
            <input type="checkbox"
                   data-on="Вкл"
                   data-off="Откл"
                   @if($banner->is_payment_enabled)
                   checked
                   @endif
                   name="is_payment_enabled"
                   data-toggle="toggle"
                   data-size="md">
        </div>
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
