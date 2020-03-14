@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Профиль</span>
            <h3 class="page-title">Профиль</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <a href="{{route('users.index')}}" type="button"
                               class="mb-2 btn btn-medium btn-primary mr-1">
                                <i class="material-icons md-12">arrow_back</i> Назад
                            </a>
                            <h6 class="m-0">Профиль</h6>
                        </div>

                        <div class="card-body p-2 pb-2 text-center">

                            @if(Auth::user()->image_path)
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <img style="height: 200px; width: auto;" class="m-2"
                                             src="{{asset(Auth::user()->image_path)}}" alt="">
                                    </div>
                                </div>
                            @endif
                            <form method="post" action="{{route('users.profile.update')}}"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <select class="form-control" name="city_id" id="city_id" required>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{Auth::user()->city_id == $city->id? ' selected ': ''}}>
                                                    {{$city->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="form-control-plaintext" for="role_id">Пожалуйста выберите
                                            город</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input value="{{Auth::user()->name}}" type="text" class="form-control"
                                               name="name"
                                               placeholder="Введите имя" required>
                                        <label class="form-control-plaintext">Введите имя</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input value="{{Auth::user()->surname}}" type="text" class="form-control"
                                               name="surname"
                                               placeholder="Введите фамилию"
                                               required>
                                        <label class="form-control-plaintext">Введите фамилию</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input value="{{Auth::user()->father_name}}" type="text" class="form-control"
                                               name="father_name"
                                               placeholder="Введите отчество">
                                        <label class="form-control-plaintext">Введите отчество</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input value="{{Auth::user()->email}}" type="email" class="form-control"
                                               name="email"
                                               placeholder="Введите email"
                                               required>
                                        <label class="form-control-plaintext">Введите email</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input value="{{Auth::user()->phone}}" type="number" minlength="11"
                                               maxlength="11"
                                               class="form-control" name="phone"
                                               placeholder="77471234567" required>
                                        <label class="form-control-plaintext">Введите номер телефона</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input type="text" value="{{Auth::user()->nickname}}" class="form-control"
                                               name="nickname"
                                               placeholder="Введите никнейм"
                                               required>
                                        <label class="form-control-plaintext">Введите никнейм</label>
                                    </div>

                                    <div class="row col-md-8">
                                        <div class="form-group col-md-9">
                                            <input type="file"
                                                   id="file"
                                                   class="form-control"
                                                   name="image"
                                                   accept="image/*"
                                                   placeholder="Фото"
                                                   required>
                                            <label class="form-control-plaintext" for="image">Пожалуйста выберите
                                                фото</label>
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

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Обновить пароль</h6>
                        </div>

                        <div class="card-body p-2 pb-2 text-center">
                            <form method="post" action="{{route('users.profile.updatePassword')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group col-md-4 text-center">
                                        <input type="password" class="form-control"
                                               name="old_password"
                                               placeholder="Введите ваш старый пароль" required>
                                        <label class="form-control-plaintext">Введите ваш старый пароль</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input type="password" class="form-control" name="password"
                                               placeholder="Введите новый пароль"
                                               required>
                                        <label class="form-control-plaintext">Введите новый пароль</label>
                                    </div>
                                    <div class="form-group col-md-4 text-center">
                                        <input type="password" class="form-control"
                                               name="password_confirmation"
                                               placeholder="Повторно введите новый пароль">
                                        <label class="form-control-plaintext">Повторно введите новый пароль</label>
                                    </div>
                                    <div class="form-group col-md-12 text-right">
                                        <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
                                            <i class="material-icons md-12">check_circle</i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="row">
            <div class="col-md-12">
                <div class="card card-small">
                    <div class="card-body">
                        @include('admin.layouts.parts.error')
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script>
        function toggleImage(el) {
            document.getElementById('file').disabled = !el.checked;
        }
    </script>
@endsection