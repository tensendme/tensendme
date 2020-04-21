@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/styles/select2.min.css')}}">

    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">Вход через номер телефона</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false">Вход через EMAIL</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-1">
                                    <div class="card-header">Вход через номер телефона</div>

                                    <div class="card-body">
                                        <img src="{{asset('1.png')}}" class="img-fluid" alt="Responsive image">
                                        <form name="phoneForm" onsubmit="return submitForm(event)" method="POST"
                                              action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="email"
                                                       class="col-md-4 col-form-label text-md-right">Номер
                                                    телефона</label>

                                                <div class="col-lg-6">

                                                    <div class="row">
                                                        <div class="col-4 d-flex justify-content-end">
                                                            <div class="dropdown w-100">
                                                                <a class="btn-block btn btn-outline-primary dropdown-toggle"
                                                                   type="button"
                                                                   id="dropdownMenuButton" data-toggle="dropdown"
                                                                   style="min-width: 60px;"
                                                                   aria-haspopup="true" aria-expanded="false">+7</a>
                                                                <div class="dropdown-menu"
                                                                     aria-labelledby="dropdownMenuButton">
                                                                    @foreach($countries as $country)
                                                                        <a class="dropdown-item"
                                                                           data-image="{{$country->image_path}}"
                                                                           data-prefix="{{$country->phone_prefix}}"
                                                                           href="#">
                                                                            @if($country->image_path)
                                                                                <img src="{{$country->image_path}}"
                                                                                     style="width:30px;">
                                                                            @endif
                                                                            {{$country->name . " ($country->phone_prefix)" }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <input id="phone"
                                                                   type="number"
                                                                   class="form-control @error('phone') is-invalid @enderror"
                                                                   name="phone">
                                                        </div>
                                                    </div>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password"
                                                       class="col-md-4 col-form-label text-md-right">Пароль</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            Запомнить меня
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Вход
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card  m-1">
                                    <div class="card-header">Вход через email</div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="email"
                                                       class="col-md-4 col-form-label text-md-right">Email</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}" required
                                                           autocomplete="email"
                                                           autofocus>

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password"
                                                       class="col-md-4 col-form-label text-md-right">Пароль</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            Запомнить меня
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Вход
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.dropdown-item').click(function () {
                $('#dropdownMenuButton').text($(this).data('prefix'));
            });
        });

        function submitForm(event) {
            var prefix = $('#dropdownMenuButton').text();
            if (prefix) {
                prefix.trim();
                if (prefix.startsWith('+')) {
                    prefix = prefix.substring(1);
                }
            } else {
                prefix = '';
            }
            document.phoneForm.phone.value = prefix + document.phoneForm.phone.value;
            return true;
        }
    </script>
@endsection