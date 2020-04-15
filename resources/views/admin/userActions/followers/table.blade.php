<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$followers->items())
            <tr>Подписчиков не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0">Реферал</th>
                <th scope="col" class="border-0">Подписчик</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="level_id">Уровень</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="created_at">Дата</a></th>

            </tr>
        @endif
        </thead>
        <tbody>
        @foreach($followers as $follower)
            <tr>
                <td>{{$follower->id}}</td>
                <td>{{$follower->hostUser->name}}</td>
                <td>{{$follower->followerUser->name}}</td>
                <td>{{$follower->level->name}}</td>
                <td>{{$follower->created_at}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
<div class="card-footer">
    @if($followers->items())
        <p style="text-align: center">Показано с {{ $followers->firstItem() }} до {{ $followers->lastItem() }}
            из {{$followers->total()}} записей</p>
        {{ $followers->links() }}
    @endif
</div>
