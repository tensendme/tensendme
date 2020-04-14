<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0">
        <thead class="bg-light">
        @if(!$withdrawals->items())
            <tr>Транзакции не найдено!</tr>
        @else
            <tr>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="id">#</a></th>
                <th scope="col" class="border-0">Пользователь</th>
                <th scope="col" class="border-0">Номер телефона</th>
                <th scope="col" class="border-0">Комментарий пользователя</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i><a class="sort" id="amount">Сумма</a></th>
                <th scope="col" class="border-0">Изменен сотрудником</th>
                <th scope="col" class="border-0">Комментарии</th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="status">Статус</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="approved_at">Изменен</a></th>
                <th scope="col" class="border-0"><i class="material-icons">height</i>
                    <a class="sort" id="created_at">Поступил</a></th>
                <th scope="col" class="border-0">Действия</th>
            </tr>
        @endif
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
                <td>{{$withdrawal->created_at}}</td>
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
    @if($withdrawals->items())
        <p style="text-align: center">Показано с {{ $withdrawals->firstItem() }} до {{ $withdrawals->lastItem() }}
            из {{$withdrawals->total()}} записей</p>
        {{ $withdrawals->links() }}
    @endif
</div>
