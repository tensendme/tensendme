@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Медитация</span>
            <h3 class="page-title">Медитация</h3>
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
                            <label for="name" class="form-control-plaintext">Название</label>
                            <input class="form-control search" type="text" name="title" placeholder="Сәтті күн">
                        </div>
                        <div class="col-3">
                            <label for="category" class="form-control-plaintext">Категория</label>
                            <select class="form-control search" type="text" name="category_id" id="category_id">
                                <option value="">Все категории</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="platform" class="form-control-plaintext">Видимость</label>
                            <select class="form-control search" type="text" name="is_visible">
                                <option value="">Все</option>
                                <option value="1">Виден</option>
                                <option value="0">Не виден</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="datemin" class="form-control-plaintext">Создан после</label>
                            <input type="date" class="form-control search" id="created_after" name="created_after" min="2020-01-01">
                        </div>
                        <div class="col-3">
                            <label for="datemax" class="form-control-plaintext">Создан до</label>
                            <input type="date" class="form-control search" id="created_before" name="created_before" min="2020-01-01">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="mb-2 btn btn-medium btn-primary mr-1" onclick="search()">Поиск
                        <i class="material-icons md-12">search</i>
                    </button>
                    <a href="{{route('meditation.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все медитации</h6>
                    <label for="perPage">Записей на одну страницу</label>
                    <select id="perPage" class="form-control col-1" onchange="search()">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div id="filterTable">
                    @include('admin.meditation.table')
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
            fetch('{{route('meditation.filter')}}?' + query)
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
            elementId = element.id;
        }
    </script>
@endsection

