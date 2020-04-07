<div class="card-body p-0 pb-3 text-center">

    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$users->items())
            <tr>Пользователей нет!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="name">ФИО</a></th>
                <th scope="col" class="border-0">Ник</th>
                <th scope="col" class="border-0">Почта</th>
                <th scope="col" class="border-0">Телефон</th>
                <th scope="col" class="border-0">Промо-код</th>
                <th scope="col" class="border-0">Город</th>
                <th scope="col" class="border-0">Роль</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="level_id">Уровень</a></th>
                <th scope="col" class="border-0">Платформа</th>
                <th scope="col" class="border-0">Баланс</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Дата регистрации</a></th>
                <th scope="col" class="border-0">Действия</th>
            </tr>
        @endif
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->surname}} {{$user->name}} {{$user->father_name}}</td>
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
                <td>{{$user->balance? $user->balance->balance: ''}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('users.edit', ['id' => $user->id])}}">
                        Изменить <i class="material-icons md-12">edit</i>
                    </a>
                    <a class="btn btn-outline-primary mb-2 "
                       onclick="sendPush({{$user->id}})">
                        Отправить пуш
                    </a>
                    <a class="btn btn-outline-primary mb-2 "
                       href="{{route('users.subscribe', ['id' => $user->id])}}">
                        Оформить подписку <i class="material-icons md-12">add</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer">
    @if($users->items())
        <p style="text-align: center">Показано с {{ $users->firstItem() }} до {{ $users->lastItem() }}
            из {{$users->total()}} записей</p>
        {{ $users->links() }}
    @endif
</div>
