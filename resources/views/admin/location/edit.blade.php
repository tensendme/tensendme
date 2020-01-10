@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Локации</span>
            <h3 class="page-title">Локации</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Обновление локации</h6>
                </div>
                <div class="card-body p-2 pb-2 text-center">
                    <form method="post" action="{{route('location.update', ['id' => $location->id])}}">
                        @include('admin.location.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
