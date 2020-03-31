@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Пользователи</span>
            <h3 class="page-title">Пользователи еще не оформившие подписку</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все пользователи</h6>
                    <div class="card">

                    </div>
                </div>
                <div class="card-header border-bottom">

                </div>
                <div class="card-body">
                    <table id="usersTable" class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>Email</th>
                            <th>Номер</th>
                            <th>Платформа</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/data/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/data/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/data/jszip.min.js')}}"></script>
    <script src="{{asset('js/data/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/data/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/data/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/data/buttons.print.min.js')}}"></script>
    <script>


        $(document).ready(function () {
            var table = $('#usersTable').DataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrltip',
                "buttons": [
                    // {
                    //     "extend": 'copy',
                    //     "text": 'Копировать данные',
                    //     "className": 'btn btn-primary'
                    // },
                    {
                        "extend": 'excel',
                        "text": 'EXCEL',
                        "className": 'btn btn-primary'
                    },
                    // {
                    //     "extend": 'pdf',
                    //     "text": 'PDF',
                    //     "className": 'btn btn-primary'
                    // },
                    {
                        "extend": 'print',
                        "text": 'Распечатать',
                        "className": 'btn btn-primary'
                    },
                ],
                "ajax": "{{ route('awaiting.data.users') }}",
                "columns": [
                    {"data": 'name'},
                    {"data": 'surname'},
                    {"data": 'father_name'},
                    {"data": 'email'},
                    {"data": 'phone'},
                    {"data": 'platform'},
                ],
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "<",
                        "next": ">",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    },
                    "select": {
                        "rows": {
                            "_": "Выбрано записей: %d",
                            "0": "Кликните по записи для выбора",
                            "1": "Выбрана одна запись"
                        }
                    }
                }
            });

        });

    </script>
@endsection
