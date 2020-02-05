@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Подписчики</span>
            <h3 class="page-title">Подписчики</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Подписчики</h6>
                </div>
                {{--                <div class="card-header border-bottom">--}}
                {{--                    <a href="{{route('level.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить--}}
                {{--                        <i class="material-icons md-12">add_circle</i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Реферал</th>
                            <th scope="col" class="border-0">Подписчик</th>
                            <th scope="col" class="border-0">Уровень</th>
                            <th scope="col" class="border-0">Дата</th>

                        </tr>
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
                    {{ $followers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
