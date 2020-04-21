@extends('admin.layouts.admin')

@section('styles')
    <style>
        .btn {
            white-space:normal !important;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Главное</span>
            <h3 class="page-title">Доска</h3>
        </div>
    </div>
    @if(Auth::user()->isAdmin())
        <div class="row">
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Подписки</span>
                                <h6 class="stats-small__value count my-3">{{$subscriptionsCount}}</h6>
                            </div>
                        </div>
                        <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">История</span>
                                <h6 class="stats-small__value count my-3">{{$historiesCount}}</h6>
                            </div>
                        </div>
                        <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Оценили</span>
                                <h6 class="stats-small__value count my-3">{{$ratingsCount}}</h6>
                            </div>
                        </div>
                        <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Пользователи</span>
                                <h6 class="stats-small__value count my-3">{{$usersCount}}</h6>
                            </div>
                        </div>
                        <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Мои подписчики</span>
                            <h6 class="stats-small__value count my-3">{{$referralNumber ?? 0}}</h6>
                            <p class="p-3">
                                <a class="btn btn-link font-weight-bold" href="{{route('referral.index')}}">Посмотреть моих ожидающих
                                    покупки подписчиков
                                </a>
                            </p>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                </div>
            </div>
        </div>
    @endif
@endsection
