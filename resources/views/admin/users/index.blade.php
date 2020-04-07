@extends('admin.layouts.admin')
@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Пользователи</span>
            <h3 class="page-title">Пользователи</h3>
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
                            <label for="phone" class="form-control-plaintext">Номер телефона</label>
                            <input class="form-control" type="text" name="phone" placeholder="707"
                                   id="phone" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}$">
                        </div>
                        <div class="col-3">
                            <label for="name" class="form-control-plaintext">Имя</label>
                            <input class="form-control" type="text" name="name" placeholder="Леонардо" id="firstName">
                        </div>
                        <div class="col-3">
                            <label for="surname" class="form-control-plaintext">Фамилия</label>
                            <input class="form-control" type="text" name="surname" placeholder="Ди" id="surname">
                        </div>
                        <div class="col-3">
                            <label for="fatherName" class="form-control-plaintext">Отчество</label>
                            <input class="form-control" type="text" name="fatherName" placeholder="Каприо"
                                   id="fatherName">
                        </div>
                        <div class="col-3">
                            <label for="fatherName" class="form-control-plaintext">Роль</label>
                            <select class="form-control" type="text" name="role" id="role">
                                <option value="">Все роли</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="level" class="form-control-plaintext">Уровень</label>
                            <select class="form-control" type="text" name="level" id="level">
                                <option value="">Все уровни</option>
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="platform" class="form-control-plaintext">Платформа</label>
                            <select class="form-control" type="text" name="platform" id="platform">
                                <option value="">Все</option>
                                <option value="IOS">Apple IOS</option>
                                <option value="ANDROID">Android</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="datemax" class="form-control-plaintext">Регистрирован до</label>
                            <input type="date" class="form-control" id="before" name="datemax" min="2020-01-01">
                        </div>
                        <div class="col-3">
                            <label for="datemin" class="form-control-plaintext">Регистрирован после</label>
                            <input type="date" class="form-control" id="after" name="datemin" min="2020-01-01">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="mb-2 btn btn-medium btn-primary mr-1" onclick="search()">Поиск
                        <i class="material-icons md-12">search</i>
                    </button>
                    <a href="{{route('users.create')}}" type="button" class="mb-2 btn btn-medium btn-primary mr-1">Добавить
                        <i class="material-icons md-12">add_circle</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Все пользователи</h6>
                    <label for="perPage">Записей на одну страницу</label>
                    <select id="perPage" class="form-control col-1" onchange="search()">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div id="usersTable">
                    @include('admin.users.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var table = document.getElementById('usersTable');
        console.log(table);

        function search() {
            var query = filter();
            fetch('{{route('users.filter')}}?' + query)
                .then((response) => response.text()).then((response) => {
                table.innerHTML = response;
                changePage();
                if(elementId != null) {
                    console.log(elementId);
                    console.log(icon);
                    console.log( document.getElementById(elementId).parentElement);
                    document.getElementById(elementId).parentElement.appendChild(icon);
                }
            }).catch((error) => {
                console.error('Error:', error);
            });


        }

        function validate_int(myEvento) {
            if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
                dato = true;
            } else {
                dato = false;
            }
            return dato;
        }

        function phone_number_mask() {
            var myMask = "(___) ___-__-__";
            var myCaja = document.getElementById("phone");
            var myText = "";
            var myNumbers = [];
            var myOutPut = ""
            var theLastPos = 1;
            myText = myCaja.value;
            //get numbers
            for (var i = 0; i < myText.length; i++) {
                if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
                    myNumbers.push(myText.charAt(i));
                }
            }
            //write over mask
            for (var j = 0; j < myMask.length; j++) {
                if (myMask.charAt(j) == "_") { //replace "_" by a number
                    if (myNumbers.length == 0)
                        myOutPut = myOutPut + myMask.charAt(j);
                    else {
                        myOutPut = myOutPut + myNumbers.shift();
                        theLastPos = j + 1; //set caret position
                    }
                } else {
                    myOutPut = myOutPut + myMask.charAt(j);
                }
            }
            document.getElementById("phone").value = myOutPut;
            document.getElementById("phone").setSelectionRange(theLastPos, theLastPos);
        }

        document.getElementById("phone").onkeypress = validate_int;
        document.getElementById("phone").onkeyup = phone_number_mask;

        function sendPush(userID) {
            bootbox.confirm(`

            <form id='infos' action=''>\
            Тема: <input class='form-control' id='bootboxTitle' type='text' name='first_name' /><br/>\
            Контент :<input class='form-control' id='bootboxDescription' type='text' name='last_name' />\
            </form>`, function (result) {
                if (result) {
                    $.ajax('/send/push/' + userID, {
                        type: 'post',
                        data: {
                            _token: $('#csrf-token')[0].content,
                            title: $('#bootboxTitle').val(),
                            description: $('#bootboxDescription').val(),
                        },
                        success: function (resp) {
                            toastr.success('Успешно отправлено!');
                        },
                        error: function (err) {
                            toastr.warning('Ошибка!');
                        }
                    })
                }
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
                            document.getElementById('usersTable').innerHTML = response;
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
            var name = document.getElementById('firstName');
            var phone = document.getElementById('phone');
            var surname = document.getElementById('surname');
            var fatherName = document.getElementById('fatherName');
            var role = document.getElementById('role');
            var level = document.getElementById('level');
            var platform = document.getElementById('platform');
            var before = document.getElementById('before');
            var after = document.getElementById('after');
            var perPage = document.getElementById('perPage');
            filter['name'] = name.value;
            filter['surname'] = surname.value;
            filter['father_name'] = fatherName.value;
            filter['role_id'] = role.value;
            filter['level_id'] = level.value;
            filter['platform'] = platform.value;
            filter['phone'] = phone.value.replace(/\D/g, '');
            filter['register_before'] = before.value;
            filter['register_after'] = after.value;
            var query = 'perPage=' + perPage.value + '&';
            if(elementId != null) {
                if(sort === 'asc')
                query = 'sort=' + elementId + '&';
                else query = 'sort=-' + elementId + '&';
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
            console.log(elementId);
        }

    </script>
@endsection
