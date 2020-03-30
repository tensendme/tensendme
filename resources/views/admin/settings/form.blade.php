{{csrf_field()}}
<div class="form-row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control"
               name="title"
               value="{{$setting->title}}"
               placeholder="Наименование"
               id="title">
        <label class="form-control-plaintext" for="title">Пожалуйста введите название</label>
    </div>
    <div class="form-group col-md-4">
        <input type="text" class="form-control"
               name="about_us"
               value="{{$setting->about_us}}"
               placeholder="Про нас"
               id="about_us">
        <label class="form-control-plaintext" for="about_us">Пожалуйста введите про нас</label>
    </div>
    <div class="form-group col-md-4">
        <input type="text" class="form-control"
               name="address"
               value="{{$setting->address}}"
               placeholder="Адрес"
               id="address">
        <label class="form-control-plaintext" for="address">Пожалуйста введите адрес</label>
    </div>
    <div class="form-group col-md-4">
        <input type="text" class="form-control"
               name="phone"
               value="{{$setting->phone}}"
               placeholder="Адрес"
               id="phone">
        <label class="form-control-plaintext" for="phone">Пожалуйста введите адрес</label>
    </div>
    <div class="form-group col-md-4">
        <input type="text" class="form-control"
               name="copyright"
               value="{{$setting->address}}"
               placeholder="Copyright@"
               id="copyright">
        <label class="form-control-plaintext" for="copyright">Пожалуйста введите copyright</label>
    </div>
{{--    <div class="form-group col-md-5">--}}
{{--        <input type="file"--}}
{{--               id="file"--}}
{{--               class="form-control"--}}
{{--               name="logo"--}}
{{--               accept="image/*"--}}
{{--               placeholder="Фото"--}}
{{--               required>--}}
{{--        <label class="form-control-plaintext" for="file">Пожалуйста выберите фото</label>--}}
{{--    </div>--}}
{{--    <div class="form-group col-md-1">--}}
{{--        <input type="checkbox"--}}
{{--               data-on="Вкл"--}}
{{--               data-off="Откл"--}}
{{--               onchange="toggleImage(this)"--}}
{{--               checked--}}
{{--               data-toggle="toggle"--}}
{{--               data-size="md">--}}
{{--    </div>--}}
</div>
<div class="form-group col-md-12 text-right">
    <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
        <i class="material-icons md-12">check_circle</i>
    </button>
</div>
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        function toggleImage(el) {--}}
{{--            document.getElementById('file').disabled = !el.checked;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
@include('admin.layouts.parts.error')
