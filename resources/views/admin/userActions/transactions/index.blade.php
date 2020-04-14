@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Транзакции</span>
            <h3 class="page-title">Транзакции</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Фильтры</h6>
                </div>
                <div class="card-body">
                    <div class="row ml-1 mt-2">
                        <div class="col-3">
                            <label class="form-control-plaintext" for="user_id">Пользотватель</label>
                            <select id="user_id" class="form-control search js-example-basic-single" name="user_id"></select>
                        </div>
                        <div class="col-3">
                            <label for="status" class="form-control-plaintext">Статус</label>
                            <select class="form-control search" id="status" type="text" name="status">
                                <option value="">Все</option>
                                <option value="0">В обработке</option>
                                <option value="1">Подтвержден</option>
                                <option value="2">Отказано</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="sum" class="form-control-plaintext">Цена</label>
                            <input class="form-control search" type="number" min="0" id="sum" name="sum" placeholder="9900">
                        </div>
                        <div class="col-3">
                            <label for="datemax" class="form-control-plaintext">Создан до</label>
                            <input type="date" class="form-control search" id="created_before" name="created_before" min="2020-01-01">
                        </div>
                        <div class="col-3">
                            <label for="datemin" class="form-control-plaintext">Создан после</label>
                            <input type="date" class="form-control search" id="created_after" name="created_after" min="2020-01-01">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="mb-2 btn btn-medium btn-primary mr-1" onclick="search()">Поиск
                        <i class="material-icons md-12">search</i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Транзакции</h6>
                    <label for="perPage">Записей на одну страницу</label>
                    <select id="perPage" class="form-control col-1" onchange="search()">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div id="filterTable">
                    @include('admin.userActions.transactions.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var table = document.getElementById('filterTable');

        function search() {
            var query = filter();
            fetch('{{route('transaction.filter')}}?' + query)
                .then((response) => response.text()).then((response) => {
                table.innerHTML = response;
                changePage();
                if(elementId != null) {
                    document.getElementById(elementId).parentElement.appendChild(icon);
                }
            }).catch((error) => {
                console.error('Error:', error);
            });


        }

        $(document).ready(function () {
            search();
        });


        function changePage() {
            var query = filter();
            document.querySelectorAll('.page-link').forEach(item => {
                item.onclick = null;
                item.onclick = function (event) {
                    var href = item.attributes.getNamedItem('href');
                    if (href) {
                        fetch(href.value + '&' + query )
                            .then((response) => response.text()).then((response) => {
                            document.getElementById('filterTable').innerHTML = response;
                            changePage();
                        }).catch((error) => {
                            console.error('Error:', error);
                        });
                    }
                    $('html, body').animate({ scrollTop: 500 }, 'fast');
                    event.preventDefault();
                    return false;
                };
            });
        }
        function filter() {
            var filter = [];
            var searchValues = document.getElementsByClassName('search');
            [].forEach.call(searchValues, function (item) {
                filter[item.name] = item.value;
            });
            var perPage = document.getElementById('perPage');
            var query = 'perPage=' + perPage.value + '&';
            if(elementId != null) {
                if(sort === 'asc')
                    query += 'sort=' + elementId + '&';
                else query += 'sort=-' + elementId + '&';
            }
            for (var key in filter) {
                if (filter[key]) {
                    query += 'filter[' + key + ']=' + filter[key] + '&';
                }
            }
            return query;
        }
        var icon = document.createElement('i');
        icon.className = 'material-icons md-18';
        var elementId = null;
        var sort = 'desc';
        $(document).on("click", ".sort", function(event){
            if(elementId == null) {
                icon.innerText = 'arrow_drop_down';
                sorting(event);
                search();
            }
            else if(elementId === event.target.id) {
                if(sort === 'desc') {
                    icon.innerText = 'arrow_drop_up';
                    sort = 'asc';
                }
                else {
                    icon.innerText = 'arrow_drop_down';
                    sort = 'desc';
                }
                search();
            }
            else {
                sorting(event);
                icon.innerText = 'arrow_drop_down';
                search();
            }
        });

        function sorting(event) {
            element = event.target;
            elementId = event.target.id;
        }
        var authorSelect = document.getElementById('user_id');
        var nextLink = '/users/select';
        var term = '';

        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            // $.onScroll()
            $('#user_id').select2({
                ajax: {
                    url: nextLink,
                    processResults: function (response, params) {
                        // var query = {
                        //     search: params.term,
                        //     page: params.page
                        // };
                        params.page = params.page || 1;
                        nextLink = response.next_page_url;
                        var pagination = false;
                        const data = response.data;
                        if (nextLink != null) pagination = true;
                        var obj = {"results": [], "pagination": {"more": pagination}};
                        data.forEach(author => {
                            obj1 = {
                                "text": author.name ? author.name : ' ' + '(+' + (author.phone || '') + ')',
                                "id": author.id
                            };
                            obj.results.push(obj1);
                        });
                        return obj;
                    }
                }
            });
        });
    </script>
@endsection

