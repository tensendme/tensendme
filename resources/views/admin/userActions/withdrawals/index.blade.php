@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Запросы</span>
            <h3 class="page-title">Запросы на снятие денег</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Запросы на снятие денег</h6>
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
                            <th scope="col" class="border-0">Пользователь</th>
                            <th scope="col" class="border-0">Номер телефона</th>
                            <th scope="col" class="border-0">Комментарий пользователя</th>
                            <th scope="col" class="border-0">Сумма</th>
                            <th scope="col" class="border-0">Изменен сотрудником</th>
                            <th scope="col" class="border-0">Комментарии</th>
                            <th scope="col" class="border-0">Статус</th>
                            <th scope="col" class="border-0">Изменен</th>
                            <th scope="col" class="border-0">Действия</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>{{$withdrawal->id}}</td>
                                <td>{{$withdrawal->user->name}}</td>
                                <td>{{$withdrawal->user->phone}}</td>
                                <td>{{$withdrawal->user_comment}}</td>
                                <td>{{$withdrawal->amount}}</td>
                                <td>{{$withdrawal->approvedByUser ? $withdrawal->approvedByUser->name : ''}}</td>
                                <td>
                                    {{$withdrawal->comment}}
                                </td>
                                <td>@if($withdrawal->status == 1)
                                        <span class="text-success">
                                            Подтвержден
                                        </span>
                                    @elseif($withdrawal->status == 0)
                                        <span class="text-info">
                                            В обработке
                                        </span>
                                        @else
                                        <span class="text-danger">
                                            Отказано
                                        </span>
                                    @endif
                                </td>
                                <td>{{$withdrawal->approved_at}}</td>
                                <td>
                                    @if($withdrawal->status == 0)
                                        <a class="btn btn-light btn-group-lg"
                                           id="editWithdrawal"
                                           data-withdrawal-id="{{$withdrawal->id}}" data-toggle="modal" data-target="#withdrawalModal">
                                            <i class="material-icons md-18">edit</i>
                                        </a>
                                    @elseif($withdrawal->status == \App\Models\Histories\WithdrawalRequest::APPROVED)
                                        <span style="color: #4cd213;"><i class="material-icons md-24">check</i></span>
                                    @else
                                        <span style="color: red;"><i class="material-icons md-24">close</i></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Запрос на вывод денег</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="d-inline" method="post" id="withdrawalForm">
                        {{csrf_field()}}
                        <label id="withdrawalId"></label>
                        <label for="exampleFormControlTextarea1">Оставить комментарии</label>
                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1"
                              rows="3" placeholder="Пожалуйста, оставьте комментарии ..."></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mb-2 btn  btn-outline-danger mr-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons md-12">close</i>Закрыть</span>
                    </button>
                        <button class="mb-2 btn  btn-outline-danger mr-1" id="cancelButton">
                            <i class="material-icons md-12">pan_tool</i>
                            Отклонить
                        </button>
                        <button class="mb-2 btn  btn-outline-success mr-1" id="confirmButton">
                            <i class="material-icons md-12">check</i>
                            Принять
                        </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var withdrawalId = 0;
    $(document).on("click", "#editWithdrawal", function () {
        withdrawalId = $(this).data('withdrawal-id');
    });

    $(document).on("click", "#cancelButton", function() {
        var url = '{{ route("withdrawal.cancel", ":id") }}';
        url = url.replace(':id',withdrawalId);
        document.getElementById("withdrawalForm").action = url;
        document.getElementById("withdrawalForm").submit();
    });

    $(document).on("click", "#confirmButton", function() {
        var url = '{{ route("withdrawal.approve", ":id") }}';
        url = url.replace(':id',withdrawalId);
        document.getElementById("withdrawalForm").action = url;
        document.getElementById("withdrawalForm").submit();
    });
</script>
@endsection
