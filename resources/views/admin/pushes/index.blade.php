@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Массовая рассылка уведомлений</span>
            <h3 class="page-title">Массовая рассылка пуш уведомлений</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Пуш уведомления</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('notification.start')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-8">
                                <label>Текст</label>
                                <input name="title" type="text" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>Тип</label>
                                <select class="form-control" name="type" id="">
                                    <option value="1">Отправить всем</option>
                                    <option value="2">Отправить не оплатившим</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-block btn-primary" type="submit" value="Запустить рассылку">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    @include('admin.layouts.parts.error')
                </div>
            </div>
        </div>
    </div>
@endsection
