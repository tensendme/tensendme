{{csrf_field()}}

@if($user->image_path)
    <div class="form-row">
        <div class="col-md-12">
            <img  style="height: 200px; width: auto;" class="m-2" src="{{asset($user->image_path)}}" alt="">
        </div>
    </div>
@endif
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <select class="form-control" name="role_id" id="role_id">
                @foreach($roles as $role)
                    <option {{$user->role_id == $role->id ? ' selected ': ''}}
                            value="{{$role->id}}">
                        {{$role->name}}
                    </option>
                @endforeach
            </select>
            <label class="form-control-plaintext" for="role_id">Пожалуйста выберите роль</label>
        </div>
    </div>
    <div class="form-group col-md-4 text-center">
        <input type="text" value="{{$user->name}}" class="form-control" name="name" placeholder="Введите имя" required>
        <label class="form-control-plaintext">Введите имя</label>
    </div>
    <div class="form-group col-md-4 text-center">
        <input type="text" value="{{$user->surname}}" class="form-control" name="surname" placeholder="Введите фамилию"
               required>
        <label class="form-control-plaintext">Введите фамилию</label>
    </div>
    <div class="form-group col-md-4 text-center">
        <input type="text" value="{{$user->father_name}}" class="form-control" name="father_name"
               placeholder="Введите отчество">
        <label class="form-control-plaintext">Введите отчество</label>
    </div>
    <div class="form-group col-md-4 text-center">
        <input type="email" value="{{$user->email}}" class="form-control" name="email" placeholder="Введите email"
               required>
        <label class="form-control-plaintext">Введите email</label>
    </div>
    {{--<div class="form-group col-md-4 text-center">--}}
        {{--<input type="text" value="{{$user->nickname}}" class="form-control" name="nickname"--}}
               {{--placeholder="Введите никнейм"--}}
               {{--required>--}}
        {{--<label class="form-control-plaintext">Введите nickname</label>--}}
    {{--</div>--}}
    <div class="form-group col-md-4 text-center">
        <input type="number" value="{{$user->phone}}" minlength="11" maxlength="11" class="form-control" name="phone"
               placeholder="77471234567" required>
        <label class="form-control-plaintext">Введите номер телефона</label>
    </div>
    <div class="form-group col-md-11">
        <input type="file"
               id="file"
               class="form-control"
               name="image"
               accept="image/*"
               placeholder="Фото"
               required>
        <label class="form-control-plaintext" for="image">Пожалуйста выберите фото</label>
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
