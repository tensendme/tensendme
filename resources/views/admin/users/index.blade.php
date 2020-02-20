@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Новости</span>
            <h3 class="page-title">Новости</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Новости</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">ФИО</th>
                            <th scope="col" class="border-0">Логин</th>
                            <th scope="col" class="border-0">Почта</th>
                            <th scope="col" class="border-0">Телефон</th>
                            <th scope="col" class="border-0">Промо-код</th>
                            <th scope="col" class="border-0">Город</th>
                            <th scope="col" class="border-0">Роль</th>
                            <th scope="col" class="border-0">Уровень</th>
                            <th scope="col" class="border-0">Платформа</th>
                            <th scope="col" class="border-0">Баланс</th>
                            <th scope="col" class="border-0">Действия</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->nickname}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if(!$user->phone && $user->city){{$user->city->country->phone_prefix}}
                                @elseif($user->phone) {{$user->phone}}@endif
                                </td>
                                <td>{{$user->promo_code}}</td>
                                <td>@if($user->city){{$user->city->name}}@endif</td>
                                <td>{{$user->role->name}}</td>
                                <td>{{$user->level->name}}</td>
                                <td>{{$user->platform}}</td>
                                <td>{{$user->balance->balance}}</td>
                                <td><a class="btn btn-outline-primary mb-2 "
                                       href="{{route('users.edit', ['id' => $user->id])}}">
                                        Поменять роль<i class="material-icons md-12">edit</i>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
