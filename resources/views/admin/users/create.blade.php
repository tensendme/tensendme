@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Добавить пользователя</span>
            <h3 class="page-title">Добавить пользователя</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <a href="{{route('users.index')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">
                        <i class="material-icons md-12">arrow_back</i> Назад
                    </a>
                    <h6 class="m-0">Добавление пользователя</h6>
                </div>

                <div class="card-body p-2 pb-2 text-center">
                    <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="role_id" id="role_id" required>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="form-control-plaintext" for="role_id">Пожалуйста выберите роль</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="city_id" id="city_id" required>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">
                                                {{$city->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="form-control-plaintext" for="role_id">Пожалуйста выберите
                                        город</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="level_id" id="level_id" required>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}">
                                                {{$level->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="form-control-plaintext" for="role_id">Пожалуйста выберите
                                        город</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 text-center">
                                <input type="text" class="form-control" name="name" placeholder="Введите имя" required>
                                <label class="form-control-plaintext">Введите имя</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="text" class="form-control" name="surname" placeholder="Введите фамилию"
                                       required>
                                <label class="form-control-plaintext">Введите фамилию</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="text" class="form-control" name="father_name"
                                       placeholder="Введите отчество">
                                <label class="form-control-plaintext">Введите отчество</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="email" class="form-control" name="email" placeholder="Введите email"
                                       required>
                                <label class="form-control-plaintext">Введите email</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="number" minlength="11" maxlength="11" class="form-control" name="phone"
                                       placeholder="77471234567" required>
                                <label class="form-control-plaintext">Введите номер телефона</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="file" class="form-control" name="image_path">
                                <label class="form-control-plaintext">Выберите фото</label>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="password" class="form-control" value="Password1!" name="password">
                                <label class="form-control-plaintext">Введите пароль (DEFAULT: Password1!)</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <button class="mb-2 btn btn-primary mr-1" type="submit">Сохранить
                                <i class="material-icons md-12">check_circle</i>
                            </button>
                        </div>


                        @include('admin.layouts.parts.error')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
