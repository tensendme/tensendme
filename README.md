# <h1>Tensend Project</h1>

### BAD TEAM

### API BASE URL: https://tensend.me/api/v1/
### FIREBASE ACCOOUNT

<hr/>

<h3> Примечание: знак ' || ' значит ИЛИ </h3>

<hr>
<br> INVALID_FIELD = 1;
<br> UNAUTHORIZED = 2;
<br> SYSTEM_ERROR = 3;
<br> AUTH_ERROR = 4;
<br> ACCESS_DENIED = 5;
<br> UNIQUE_RESOURCE_CONFLICT = 6;
<br> RESOURCE_NOT_FOUND = 7;
<br> INVALID_ARGUMENT = 8;
<br> INVALID_TOKEN = 9;
<br> INVALID_RESET_CODE = 10;
<br> INVALID_PASSWORD_FORMAT = 11;
<br> INVALID_EMAIL_FORMAT = 12;
<br> INVALID_USERNAME_FORMAT = 13;
<br> EXPIRED_RESET_CODE = 14;
<br> EXPIRED_TOKEN = 15;
<br> EMPTY_CODE = 16;
<br> FILE_NOT_FOUND = 17;
<br> TOO_LARGE_FILE_SIZE = 18;
<br> REQUIRED_PARAMS_NOT_FOUND = 19;
<br> ALREADY_EXISTS = 20;
<br> ALREADY_REQUESTED = 21;
<br> NOT_ALLOWED = 22;
<br> PASSWORDS_MISMATCH = 23;
<br> FIELD_REQUIRED = 24;
<br> NOT_ENOUGH_BALANCE = 25;
<br> INVALID_LOGIN = 26;
<br> INVALID_PASSWORD = 27;
<hr>

### Авторизация:
#### URL: https://tensend.me/api/v1/login
#### IMAGE BASE URL: https://tensend.me/images/{$image_name}
##### Токен передается через HEADER: Authorization => Bearer Token
````
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA
````
ПО EMAIL:

```
    POST Request:
    {
    	"email" : "admin@mail.ru",
    	"password" : "password",
        "device_token" : "fcm_token",
        "platform" : "IOS" // IOS или ANDROID в стринге 
    }
    
    Response
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA",
        "success": true
    }

```

ПО Номеру телефона:

```
    POST Request:
    {
    	"phone" : "77059049554",
    	"password" : "password"
    }
    
    Response
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA",
        "success": true
    }

```

### Отправка проверочного кода:
#### URL: https://tensend.me/api/v1/code/send

ПО EMAIL:

```
    POST Request:
    {
    	"email" : "asilkhan-al@mail.ru"
    }
    
    Response
    {
        "message": "Code sent",
        "success": true
    }

```

ПО Номеру телефона:

```
    POST Request:
    {
    	"phone" : "77059049554"
    }
    
    Response
    {
        "message": "Code sent",
        "success": true
    }

```
### Проверка кода
#### URL: https://tensend.me/api/v1/code/check

```
    POST Request:
    {
    	"login" : "77059049554", // Можно передавать либо email либо номер телефона
    	"code" : "0000" // BACK_DOOR 0000
    }
    
    RESPONSE:
    {
        "is_right": true,
        "success": true
    }
    
    ||
    
    {
        "is_right": false,
        "success": true
    }

```

### Сбросить пароль
#### URL: https://tensend.me/api/v1/code/reset
#### !Надо дополнительно отправить код
ПО EMAIL:

```
    POST Request:
    {
    	"email" : "admin@mail.ru",
    	"code" : "0000",
    	"password" : "123123123"
    }
    
    Response
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvY29kZVwvcmVzZXQiLCJpYXQiOjE1Nzk2MzA3MTQsImV4cCI6MTU3OTYzNDMxNCwibmJmIjoxNTc5NjMwNzE0LCJqdGkiOiI5STRTazNIazZBUHVGZFBOIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.mtFTUDTuXJxTAoW-iflgu-tleCy04DsMsWPI9i5jRcY",
        "success": true
    }
    
    ||
    
    {
        "errors": [
            "No user with such login"
        ],
        "errorCode": 7,
        "success": false
    }

```

ПО Номеру телефона:

```
    POST Request:
    {
    	"phone" : "77059049553",
    	"code" : "0000",
    	"password" : "123123123"
    }
    
    Response
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvY29kZVwvcmVzZXQiLCJpYXQiOjE1Nzk2MzA3MTQsImV4cCI6MTU3OTYzNDMxNCwibmJmIjoxNTc5NjMwNzE0LCJqdGkiOiI5STRTazNIazZBUHVGZFBOIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.mtFTUDTuXJxTAoW-iflgu-tleCy04DsMsWPI9i5jRcY",
        "success": true
    }
    
    ||
    
    {
        "errors": [
            "No user with such login"
        ],
        "errorCode": 7,
        "success": false
    }

```
### Проверка логина на существование
#### URL: https://tensend.me/api/v1/login/check

```
    POST Request:
    {
    	"phone" : "77059049554"
    }
    
    ||
    
    {
    	"email" : "admin@mail.ru"
    }
    
    RESPONSE:
    {
        "is_exists": true,
        "success": true
    }
    ||
    {
        "is_exists": false,
        "success": true
    }

```


### Регистрация
#### URL: https://tensend.me/api/v1/register

```
    POST Request:
    {
    	"email" : "admin@mail.rr",
    	"password" : "password"
    }
    ||
    {
        "phone" : "77059049554",//БЕЗ +
        "password" : "password"
    }
    RESPONSE:
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVnaXN0ZXIiLCJpYXQiOjE1Nzk4OTk0MzksImV4cCI6MTU3OTkwMzAzOSwibmJmIjoxNTc5ODk5NDM5LCJqdGkiOiI1ZHo4UHRvZktPaDlqT2F6Iiwic3ViIjo4LCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.UFwfblZ-ODHRXzPkt7AenXHp_Z5bVoUM_nXAt4HE5EU",
        "success": true
    }

```

### Вставить Firebase push token  АВТОРИЗОВАННЫЙ
#### URL: https://tensend.me/api/v1/set-device-token

```
    POST Request:
    {
    	"device_token" : "123",
    	"platform" : "" // IOS , ANDROID - передавайте стрингом одно из двух
    }
    
    RESPONSE:
    {
         "message": "Device token set",
         "success": true
    }

```
### Получение всех категорий (пагинировано)
#### URL: https://tensend.me/api/v1/courses/categories

```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    
    RESPONSE
    {
        "categories": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "name": "TestCourseCategory",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "category_type_id": 1,
                    "parent_category_id": null
                },
                {
                    "id": 2,
                    "name": "TestMeditationCategory",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "category_type_id": 2,
                    "parent_category_id": null
                }
            ],
            "first_page_url": "https://tensend.me/api/v1/categories?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "https://tensend.me/api/v1/categories?page=1",
            "next_page_url": null,
            "path": "https://tensend.me/api/v1/categories",
            "per_page": 10,
            "prev_page_url": null,
            "to": 2,
            "total": 2
        },
        "success": true
    }

```
### Получение всех категорий (пагинировано)
#### URL: https://tensend.me/api/v1/meditations/categories

```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    
    RESPONSE
    {
        "categories": {
            "current_page": 1,
            "data": [
                {
                    "id": 2,
                    "name": "TestMeditationCategory",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "category_type_id": 2,
                    "parent_category_id": null
                }
            ],
            "first_page_url": "https://tensend.me/api/v1/meditations/categories?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "https://tensend.me/api/v1/meditations/categories?page=1",
            "next_page_url": null,
            "path": "https://tensend.me/api/v1/meditations/categories",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        },
        "success": true
    }

```
### Получение всех медитаций (пагинировано)
#### URL: https://tensend.me/api/v1/meditations

```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    
    RESPONSE
    {
        "meditations": {
            "current_page": 1,
            "data": [
                {
                    "id" : 1,
                    "category_id" : 1,
                    "title" : "Test",
                    "description" : "Test",
                    "scale": 3.75,
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "img_path": "images/meditations/1581402953a2cf3257-fbee-427d-9a32-0e54bfae0b87natures-temples.jpg",
                    "duration_time": 3
                },
                {
                    "id" : 1,
                    "category_id" : 1,
                    "title" : "Test",
                    "description" : "Test",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "img_path": "images/meditations/1581402953a2cf3257-fbee-427d-9a32-0e54bfae0b87natures-temples.jpg",
                    "duration_time": 3
                }
            ],
            "first_page_url": "https://tensend.me/api/v1/meditations?page=1",
            "from": null,
            "last_page": 1,
            "last_page_url": "https://tensend.me/api/v1/meditations?page=1",
            "next_page_url": null,
            "path": "https://tensend.me/api/v1/meditations",
            "per_page": "1",
            "prev_page_url": null,
            "to": null,
            "total": 0
        },
        "success": true
    }

```
### Получение всех курсов по категории id (пагинировано)
#### URL: https://tensend.me/api/v1/courses/category/{categoryId}
```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    
    RESPONSE
    {
        "courses": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "category_id": 1,
                    "title": "bekza",
                    "description": "fds",
                    "image_path": "images/courses/default.png",
                    "is_visible": 1,
                    "scale": 3.75,
                    "view_count": 0,
                    "created_at": "2020-01-25 03:46:36",
                    "updated_at": "2020-02-03 15:05:30",
                    "deleted_at": null,
                    "author_id": 1,
                    "lessons_count": 15,
                    "lessons_passing_count": 0,
                    "started": true,
                    "author": {
                        "id": 1,
                        "name": "Admin",
                        "email": "admin@mail.ru",
                        "image_path": "test"
                    }
                }
            ],
            "first_page_url": "http://localhost:8000/api/v1/courses/category/1?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://localhost:8000/api/v1/courses/category/1?page=1",
            "next_page_url": null,
            "path": "http://localhost:8000/api/v1/courses/category/1",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        },
        "success": true
    }
```
### Получение курса по id
#### URL: https://tensend.me/api/v1/courses/{id}
```
    GET Request
    
    RESPONSE
    {
        "course": {
            "id": 1,
            "category_id": 1,
            "title": "bekza",
            "description": "fds",
            "image_path": "images/courses/default.png",
            "is_visible": 1,
            "scale": 3.75,
            "view_count": 0,
            "created_at": "2020-01-25 03:46:36",
            "updated_at": "2020-02-03 15:05:30",
            "deleted_at": null,
            "author_id": 1,
            "access": false,
            "lessons_count": 15,
            "lessons_passing_count": 4,
            "started": true,
            "lessons": [
                {
                    "id": 2,
                    "title": "bekza",
                    "img_path": null,
                    "duration_time": null,
                    "access": true,
                    "passed": false
                },
                {
                    "id": 3,
                    "title": "bekza",
                    "img_path": null,
                    "duration_time": null,
                    "access": true,
                    "passed": false
                },
                {
                    "id": 1,
                    "title": "ffdsfsd",
                    "img_path": null,
                    "duration_time": null,
                    "access": false,
                    "passed": false
                },
                {
                    "id": 4,
                    "title": "bekza",
                    "img_path": null,
                    "duration_time": null,
                    "access": false,
                    "passed": false
                },
                {
                    "id": 5,
                    "title": "bekza",
                    "img_path": null,
                    "duration_time": null,
                    "access": false,
                    "passed": false
                }
            ]
        },
        "success": true
    }
```
### Получение курсов по title (пагинировано)
#### URL: https://tensend.me/api/v1/courses/?title=courseName
```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    ?title=course // название курса
    
    RESPONSE
    {
        "courses": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "category_id": 1,
                    "title": "bekza",
                    "description": "fds",
                    "image_path": "images/courses/default.png",
                    "is_visible": 1,
                    "scale": 3.75,
                    "view_count": 0,
                    "created_at": "2020-01-25 03:46:36",
                    "updated_at": "2020-02-03 15:05:30",
                    "deleted_at": null,
                    "author_id": 1,
                    "information_list": [
                        "Nothing"
                    ],
                    "lessons_count": 15,
                    "started": true,
                    "lessons_passing_count": 0,
                    "author": {
                        "id": 1,
                        "name": "Admin",
                        "email": "admin@mail.ru",
                        "image_path": "test"
                    }
                }
            ],
            "first_page_url": "http://localhost:8000/api/v1/courses?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://localhost:8000/api/v1/courses?page=1",
            "next_page_url": null,
            "path": "http://localhost:8000/api/v1/courses",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        },
        "success": true
    }
```
### Получение всех курсов (пагинировано)
#### URL: https://tensend.me/api/v1/courses
```
    GET Request
    Query Parameter
    ?page=0 // от 0 до ~
    ?size=10 // по дефолту можно не передавать, количество выводимых элементов
    
    RESPONSE
{
    "courses": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "category_id": 1,
                "title": "bekza",
                "description": "fds",
                "image_path": "images/courses/default.png",
                "is_visible": 1,
                "scale": 3.75,
                "view_count": 0,
                "trailer": "test",
                "created_at": "2020-01-25 03:46:36",
                "updated_at": "2020-02-03 15:05:30",
                "deleted_at": null,
                "author_id": 1,
                "information_list": [
                        "Nothing"
                ],
                "lessons_count": 15,
                "lessons_passing_count": 0,
                "started": true,
                "author": {
                    "id": 1,
                    "name": "Admin",
                    "email": "admin@mail.ru",
                    "image_path": "test"
                }
            }
        ],
        "first_page_url": "http://localhost:8000/api/v1/courses?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:8000/api/v1/courses?page=1",
        "next_page_url": null,
        "path": "http://localhost:8000/api/v1/courses",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    },
    "success": true
}
```
### Получение всех баннеров
#### URL: https://tensend.me/api/v1/banners
```
    GET Request
    
    RESPONSE
    {
        "banners": [
            {
                "id": 1,
                "news_id": 1,
                "image_path": "images/banner/1584206855755631b5-24b0-471c-951a-2639b79edfd9img.png",
                "title": "Баннер 1",
                "created_at": "2020-03-12 17:19:05",
                "updated_at": "2020-03-22 16:33:06",
                "location_id": 1,
                "link_url": "https://tensend.me",
                "is_payment_enabled": 1
            },
            {
                "id": 2,
                "news_id": 1,
                "image_path": "images/banner/1584206599a7e431cc-0a5f-4c8c-b919-ab5b475a7f0dimg.png",
                "title": "Баннер 2",
                "created_at": "2020-03-14 23:23:19",
                "updated_at": "2020-03-19 22:39:33",
                "location_id": 2,
                "link_url": "https://tensend.me",
                "is_payment_enabled": 0
            },
            {
                "id": 3,
                "news_id": 1,
                "image_path": "images/banner/1584206712a4340fe4-899a-4d6e-8f99-da82fd94a5f1img.png",
                "title": "Банер 3",
                "created_at": "2020-03-14 23:25:12",
                "updated_at": "2020-03-19 22:40:40",
                "location_id": 3,
                "link_url": "https://tensend.me",
                "is_payment_enabled": 0
            }
        ],
        "success": true
    }
```

### Получение всех баннеров по имени локации
#### URL: https://tensend.me/api/v1/banner/location/{location_name}
```
{
    "banners": [
        {
            "id": 1,
            "news_id": 1,
            "image_path": "images/banner/1584206855755631b5-24b0-471c-951a-2639b79edfd9img.png",
            "title": "Баннер 1",
            "created_at": "2020-03-12 17:19:05",
            "updated_at": "2020-03-14 23:27:35",
            "location_id": 1,
            "link_url": "https://tensend.me"
        }
    ],
    "success": true
}

```



### Получение всех локаций
#### URL: https://tensend.me/api/v1/locations
```
{
    "locations": [
        {
            "id": 1,
            "name": "Top",
            "created_at": "2020-03-12 17:17:57",
            "updated_at": "2020-03-12 17:17:57"
        },
        {
            "id": 2,
            "name": "Middle",
            "created_at": "2020-03-14 22:22:32",
            "updated_at": "2020-03-14 22:22:32"
        },
        {
            "id": 3,
            "name": "Downsize",
            "created_at": "2020-03-14 22:22:59",
            "updated_at": "2020-03-14 22:22:59"
        }
    ],
    "success": true
}

```

### Получение моих курсов (пагинировано)
#### URL: https://tensend.me/api/v1/users/courses
##### Токен передается через HEADER: Authorization => Bearer Token
````
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA
````
```
    GET Request
    Query Parameter
        ?page=0 // от 0 до ~
        ?size=10 // по дефолту можно не передавать, количество выводимых элементов

    RESPONSE
    {
        "courses": [
            {
                "id": 2,
                "category_id": 1,
                "title": "Как заработать миллион за час",
                "description": "Как заработать миллион за час",
                "image_path": "images/courses/1579896428402653d0-731d-47f6-8263-a4ad6b214c05mazda.jpg",
                "is_visible": 1,
                "scale": 3,
                "view_count": 0,
                "trailer": "test",
                "created_at": "2020-01-21 23:44:24",
                "updated_at": "2020-02-07 12:49:37",
                "deleted_at": null,
                "author_id": null,
                "information_list": [
                        "Nothing"
                ],
                "lessons_count": 4,
                "lessons_passing_count": 1,
                "started": true
            },
            {
                "id": 1,
                "category_id": 1,
                "title": "dsffdss",
                "description": "dvcxv",
                "image_path": "images/courses/1579933828738c3e35-8fe4-4473-a89a-7878fd810048CRAZY.jpg",
                "is_visible": 1,
                "trailer": "test",
                "scale": 3,
                "view_count": 0,
                "created_at": "2020-01-19 20:11:06",
                "updated_at": "2020-02-07 12:49:30",
                "deleted_at": null,
                "author_id": null,
                "lessons_count": 1,
                "lessons_passing_count": 1,
                "started": true
            }
        ],
        "success": true
    }
```
### Получение новости по id он берется с баннеров news_id
#### URL: https://tensend.me/api/v1/news/{id}
```
    GET Request
    
    RESPONSE
    {
        "news": [
            {
                "id": 1,
                "title": "День Сурка",
                "image_path": "/news/День Сурка1579630224.png",
                "description": "День Сурка",
                "created_at": "2020-01-22 00:10:24",
                "updated_at": "2020-01-22 00:10:24",
                "deleted_at": null
            }
        ],
        "success": true
    }
```
### Получение всех стран
#### URL: https://tensend.me/api/v1/countries
```
    GET Request
    
    RESPONSE
    {
        "countries": [
            {
                "id": 1,
                "name": "Казахстан",
                "phone_prefix": "+7"
            },
            {
                "id": 2,
                "name": "Россия",
                "phone_prefix": "+7"
            }
        ],
        "success": true
    }
```

### Получение материала
#### URL: https://tensend.me/api/v1/courses/material/{materialId}
```
    GET Request
    
    RESPONSE
    {
        "material": {
            "id": 3,
            "title": "bekza",
            "video_path": "videos/lessons/15813154548de4f2a2-1df7-4346-a092-7f7e6cf5c1f9SampleVideo_1280x720_1mb.mp4",
            "ordering": 1,
            "course_id": 1,
            "created_at": "2020-02-10 12:17:34",
            "updated_at": "2020-02-10 12:17:34",
            "img_path": null,
            "duration_time": 1, минут
            "free": 0, 0 С Подпиской 1 Бесплатно
            "view_count": 0,
            "description": "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
            "documents": [
                {
                    "id": 1,
                    "course_material_id": 3,
                    "type": "docx",
                    "doc_path": "documents/lessons/1581315454ad48f6f7-7b52-40ab-bda4-36936c085bd050terms_Aldanazar_ASSYLKHAN.docx"
                }
            ],
            "course": {
                "id": 1,
                "category_id": 1,
                "title": "bekza",
                "description": "fds",
                "image_path": "images/courses/default.png",
                "is_visible": 1,
                "scale": 3.75,
                "view_count": 0,
                "created_at": "2020-01-25 03:46:36",
                "updated_at": "2020-02-03 15:05:30",
                "deleted_at": null,
                "author_id": 1,
                "information_list": null
            }
        },
        "success": true
    }
```
### Получение типов подписок для(покупка разрешения на просмотров курсов)
#### URL: https://tensend.me/api/v1/subscription/types
```
    GET Request
    
    RESPONSE
    {
      {
          "subscription_types": [
              {
                  "id": 1,
                  "name": "Месяц",
                  "price": 43243,
                  "created_at": "2020-01-25 03:41:58",
                  "updated_at": "2020-01-25 03:41:58",
                  "expired_at": 30
              }
          ],
          "success": true
      }
    }
```
### Подписаться на курс по типу подписок(месяц год)
#### URL: https://tensend.me/api/v1/subscribe/{subscriptionTypeId}

```
    POST Request:
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA
    RESPONSE:
    {
        "message": "Успешно!",
        "success": true
    }
{
    "errors": [
        "Такой подписки не существует!"
    ],
    "errorCode": 7,
    "success": false
}

```
### Запрос на перевод денег
#### URL: https://tensend.me/api/v1/withdrawal/make

```
     POST Request:
        {
        	"amount" : "1000" сумма,
        	"сomment" : "Please" nullable true,
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "message": "Ваш запрос успешно отправлен и тд!",
        "success": true
    }
{
    "errors": [
        "Не хватает баланса"
    ],
    "errorCode": 25,
    "success": false
}

```
### Запрос на начальную чем вы интересуетесь категории
#### URL: https://tensend.me/api/v1/categories

```
     GET Request:
    RESPONSE:
    {
        {
            "categories": [
                {
                    "id": 1,
                    "name": "TestCourseCategory",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "category_type_id": 1,
                    "parent_category_id": null,
                    "img_path": null
                },
                {
                    "id": 2,
                    "name": "TestMeditationCategory",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null,
                    "category_type_id": 2,
                    "parent_category_id": null,
                    "img_path": null
                }
            ],
            "success": true
        }
    }
}

```
### Запрос на выбранные категории для рекомендованных курсов
#### URL: https://tensend.me/api/v1/recommended/categories

```
     POST Request:
        {
        	"categoryIds[]" : 1, id category_id
        	"categoryIds[]" : 2, id category_id
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "success": true
    }
}

```

### Запрос на вам может понравиться вывод курсов
#### URL: https://tensend.me/api/v1/courses/for/me

```
     GET Request
     Query Parameter
     size=10 // по дефолту можно не передавать, количество выводимых элементов
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        {
            "courses": [
                {
                    "current_page": 1,
                    "data": [
                        {
                            "id": 1,
                            "category_id": 1,
                            "title": "dsffdss",
                            "description": "dvcxv",
                            "image_path": "images/courses/1579933828738c3e35-8fe4-4473-a89a-7878fd810048CRAZY.jpg",
                            "is_visible": 0,
                            "scale": 0,
                            "view_count": 0,
                            "created_at": "2020-01-19 20:11:06",
                            "updated_at": "2020-02-02 19:12:52",
                            "deleted_at": null,
                            "author_id": null,
                            "trailer": "test",
                            "lessons_count": 15,
                            "lessons_passing_count": 4,
                            "started": true,
                            "information_list": [
                                "Nothing"
                            ],
                            "author": null
                        },
                        {
                            "id": 2,
                            "category_id": 1,
                            "title": "Как заработать миллион за час",
                            "description": "Как заработать миллион за час",
                            "image_path": "images/courses/1579896428402653d0-731d-47f6-8263-a4ad6b214c05mazda.jpg",
                            "is_visible": 1,
                            "scale": 0,
                            "view_count": 0,
                            "trailer": "test",
                            "lessons_count": 15,
                            "lessons_passing_count": 4,
                            "started": true,
                            "created_at": "2020-01-21 23:44:24",
                            "updated_at": "2020-01-25 02:07:08",
                            "deleted_at": null,
                            "author": {
                                         "id": 1,
                                         "name": "Admin",
                                         "email": "admin@mail.ru",
                                         "image_path": "test"
                                      }
                        }
                    ],
                    "first_page_url": "https://tensend.me/api/v1/courses/for/me?page=1",
                    "from": 1,
                    "last_page": 1,
                    "last_page_url": "https://tensend.me/api/v1/courses/for/me?page=1",
                    "next_page_url": null,
                    "path": "https://tensend.me/api/v1/courses/for/me",
                    "per_page": 10,
                    "prev_page_url": null,
                    "to": 2,
                    "total": 2
                },
            ],
            "success": true
        }
    }
}

```

### Запрос оценка курса (рейтинг звезды)
#### URL: https://tensend.me/api/v1/evaluate/course

```
     POST Request:
        {
        	"course_id" : 1, id number 
        	"scale" : 3.5, number from 0 to 5
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
        {
            "message": "Спасибо за вашу оценку!",
            "success": true
        }
        "errors": [
                "Курс не найден"
            ],
            "errorCode": 7,
            "success": false
}

```
### Запрос оценка курса (рейтинг звезды)
#### URL: https://tensend.me/api/v1/evaluate/meditation

```
     POST Request:
        {
        	"meditation_id" : 1, id number 
        	"scale" : 3.5, number from 0 to 5
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
        {
            "message": "Спасибо за вашу оценку!",
            "success": true
        }
        "errors": [
                "Медитация не найдена"
            ],
            "errorCode": 7,
            "success": false
}

```

### Запрос оценка курса (рейтинг звезды)
#### URL: https://tensend.me/api/v1/courses/material/pass

```
     POST Request:
        {
        	"lessonId" : 1, id number 
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
        {
            "message": "Просмотренный курс!",
            "success": true
        }
{
            "message": "Урок успешно просмотрен!",
            "success": true
        }
        "errors": [
                "Урок не найден"
            ],
            "errorCode": 7,
            "success": false
}

```

### Запрос на подписку через промокод
#### URL: https://tensend.me/api/v1/follow

```
     POST Request:
        {
        	"promoСode" : "YN3KHL" promoCode user,
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "message": "Промокод принят успешно!",
        "success": true
    }
{
    "errors": [
        "Не найден промо-код"
    ],
    "errorCode": 7,
    "success": false
    
    ["У вас уже существует подписка"],
    "errorCode": 20,
    "success": false
}
```

### Запрос на профиль
#### URL: https://tensend.me/api/v1/profile

```
     GET Request
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "profile": {
            "id": 1,
            "avatar": "images/avatars/158416023427f3a2d6-4713-4f20-be77-55436a4066d7img.jpg",
            "name": "Admin",
            "surname": "Admin",
            "phone": "7123123123",
            "fatherName": "Admin",
            "promoCode": "12JO3V",
            "created": null,
            "levelId": 1,
            "level": "Бастаушы",
            "levelImage": "images/levels/1584279933b5de32b3-617e-4c19-9de4-e4da33b3d3a0img.png",
            "discountPercentage": 20,
            "balance": 0,
            "city": "Алматы",
            "role": "Пользователь",
            "followers_count": 0,
            "nickname": null,
            "permission": true,
            "activity": 4,
            "tensend": 5,
            "rating": 6,
            "passed": 6,
            "analyze": [
                {
                    "type": 1,
                    "count": 1
                },
                {
                    "type": 2,
                    "count": 0
                },
                {
                    "type": 3,
                    "count": 0
                }
            ],
            "subscriptions": [],
            "levels": [
                {
                    "id": 1,
                    "name": "Бастаушы",
                    "start_count": 0,
                    "end_count": 10,
                    "discount_percentage": 20,
                    "created_at": null,
                    "updated_at": "2020-03-16 02:05:19",
                    "period_date": 365,
                    "logo": "images/levels/1584279933b5de32b3-617e-4c19-9de4-e4da33b3d3a0img.png",
                    "description": "Tensend қосымшасының жылдық және 3 айлық жазылымын 10 сатып әр сатылымнан 20 % табыс табыңыз және Toyota Camry 70 автокөлігінің ұтыс ойынына қатысыңыз.\r\nАвтокөлік ұтыс ойынына тек жылдық жазылым сатылымдары есепке алынады.\r\n\r\nTensend қосымшасының 10 жылдық жазылымын сатсаңыз Сіздің табысыңыз - 49 800 теңгені құрайды."
                },
                {
                    "id": 2,
                    "name": "Кәсіпкер",
                    "start_count": 10,
                    "end_count": 50,
                    "discount_percentage": 30,
                    "created_at": "2020-03-16 01:56:59",
                    "updated_at": "2020-03-16 02:04:27",
                    "period_date": 365,
                    "logo": "images/default.png",
                    "description": "Tensend қосымшасының жылдық және 3 айлық жазылымын 10 мен 50 аралығында сатып әр сатылымнан 30 % табыс табыңыз.\r\n\r\nTensend қосымшасының 10 мен 50 аралығында жылдық жазылымын сатсаңыз Сіздің табысыңыз - 291 330 теңгені құрайды."
                },
                {
                    "id": 3,
                    "name": "Бизнесмен",
                    "start_count": 50,
                    "end_count": 100,
                    "discount_percentage": 40,
                    "created_at": "2020-03-16 01:58:50",
                    "updated_at": "2020-03-16 02:04:12",
                    "period_date": 365,
                    "logo": "images/default.png",
                    "description": "Tensend қосымшасының жылдық және 3 айлық жазылымын 50 мен 100 аралығында сатып әр сатылымнан 40 % табыс табыңыз. \r\n\r\nTensend қосымшасының 50 мен 100 аралығында жылдық жазылымын сатсаңыз Сіздің табысыңыз - 488 040 теңгені құрайды."
                },
                {
                    "id": 4,
                    "name": "Саяхатшы",
                    "start_count": 101,
                    "end_count": 3000,
                    "discount_percentage": 50,
                    "created_at": "2020-03-16 02:03:31",
                    "updated_at": "2020-03-16 02:06:02",
                    "period_date": 365,
                    "logo": "images/default.png",
                    "description": "Tensend қосымшасының жылдық жазылымның 100 ден жоғары әр сатылымнан 50 % табыс табыңыз және тегін шетелге саяхатқа жолдама алыңыз. Саяхатқа тегін жолдама тек жылдық жазылым сатылымдарына есепке алынады.\r\n\r\nӘр жылдық жазылымнан енді 50%, яғни 12 450 теңге табыс табыңыз.\r\nӘр 3 айлық жазылымнан енді 50%, яғни 6 450 теңге табыс табыңыз."
                }
            ]
        },
        "success": true
    }
```

### Запрос редактирование профиля
#### URL: https://tensend.me/api/v1/profile/update

```
     POST Request:
        {
        	"name" : "Test" name,
        	"surname" : "Test" surname,
        	"fatherName" : "Test" father name,
        	"nickname" : "Test" String,
        	"cityId" : 1 numeric,
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "message": "Профиль изменен успешно!",
        "success": true
    }
```
### Запрос поменять аватар
#### URL: https://tensend.me/api/v1/profile/avatar

```
     POST Request:
        {
        	"avatar" : image
        	
        }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "message": "Аватар изменен успешно!",
        "success": true
    }
```

### Запрос на медитацию
#### URL: https://tensend.me/api/v1/meditation/{id}

```
     GET Request
        Query Parameter
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "meditation": {
            "title": "tbekza",
            "description": "tfsdfsf",
            "img_path": "images/meditations/1581402673d8f6c2c9-baae-4301-987f-20057169d914QR_157978119097714835372136008369617.gif",
            "access": false,
            "scale": 3.75,
            "duration": 2,
            "audios": [
                {
                    "id": 1,
                    "audio_path": "",
                    "img_path": null,
                    "free": 0,
                    "duration": 27,
                    "access": false,
                    "author": {
                        "id": 11,
                        "name": "Bekzat",
                        "email": "bekzattttt@mail.ru",
                        "phone": "707257752",
                        "image_path": null
                    },
                    "language": {
                        "id": 1,
                        "name": "Русский"
                    }
                },
                {
                    "id": 2,
                    "audio_path": "audios/meditations/1582289917b50f2b52-0711-41fd-b2da-bf0b7a55ffb4file_example_MP3_5MG.mp3",
                    "img_path": null,
                    "free": 1,
                    "duration": 3,
                    "access": true,
                    "author": {
                        "id": 12,
                        "name": "Bekzat1",
                        "email": "bekzatttdt@mail.ru",
                        "phone": "7077376258",
                        "image_path": null
                    },
                    "language": {
                        "id": 2,
                        "name": "Казахский"
                    }
                },
                {
                    "id": 3,
                    "audio_path": "audios/meditations/1582289942dd00f703-7a23-4640-83a4-ceeacf461a61file_example_MP3_700KB.mp3",
                    "img_path": null,
                    "free": 1,
                    "duration": 1,
                    "access": true,
                    "author": {
                        "id": 10,
                        "name": "Bekzat",
                        "email": "bekzatttt@mail.ru",
                        "phone": null,
                        "image_path": null
                    },
                    "language": {
                        "id": 1,
                        "name": "Русский"
                    }
                },
                {
                    "id": 4,
                    "audio_path": "audios/meditations/15822899722ce71c0e-44fc-4580-b86e-b9b5d7b406c8file_example_MP3_5MG.mp3",
                    "img_path": null,
                    "free": 1,
                    "duration": 3,
                    "access": true,
                    "author": {
                        "id": 9,
                        "name": "Bekzat",
                        "email": "bekzattt@mail.ru",
                        "phone": null,
                        "image_path": null
                    },
                    "language": {
                        "id": 1,
                        "name": "Русский"
                    }
                },
                {
                    "id": 5,
                    "audio_path": "audios/meditations/1582289772e154d8ae-74bd-416f-aed0-e973b9d8a543file_example_MP3_5MG.mp3",
                    "img_path": null,
                    "free": 1,
                    "duration": 2,
                    "access": true,
                    "author": {
                        "id": 12,
                        "name": "Bekzat1",
                        "email": "bekzatttdt@mail.ru",
                        "phone": "7077376258",
                        "image_path": null
                    },
                    "language": {
                        "id": 1,
                        "name": "Русский"
                    }
                }
            ]
        },
        "success": true
    }
```

### Запрос на покупку подписки
#### URL: https://tensend.me/api/v1/pay?subscription_type_id={id}&token={user_token}

```
    GET Request

    RESPONSE:
    Ответ приходит в виде вьюшки пример ниже:
    https://tensend.me/payView.png
```

### Запрос на сохранение карты
#### URL: https://tensend.me/api/v1/saveCard?token={user_token}

```
    GET Request
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    Ответ приходит в виде вьюшки пример ниже:
    https://tensend.me/payView.png
```


### Запрос на вывод всех карт пользователя
#### URL: https://tensend.me/api/v1/user/cards

```
    GET Request
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
 {
     "cards": [
         {
             "id": 10,
             "token": "2F725BBD1F405A1ED0336ABAF85DDFEB6902A9984A76FD877C3B5CC3B5085A82",
             "type": "/images/masterCardLogo.png",
             "last_four": "4444"
         },
         {
             "id": 11,
             "token": "DAB9CC59244BADFAA02AAA94FE759DE1B6FF990A7F88ABC46D99EB796856BC18",
             "type": "/images/masterCardLogo.png",
             "last_four": "5323"
         },
         {
             "id": 12,
             "token": "9BBEF19476623CA56C17DA75FD57734DBF82530686043A6E491C6D71BEFE8F6E",
             "type": "/images/visaLogo.png",
             "last_four": "1111"
         },
         {
             "id": 13,
             "token": "477BBA133C182267FE5F086924ABDC5DB71F77BFC27F01F2843F2CDC69D89F05",
             "type": "/images/visaLogo.png",
             "last_four": "4242"
         }
     ],
     "success": true
 }
```

### Запрос на покупку подписки через кредитную карту (токен карты)
#### URL: https://tensend.me/api/v1/card/pay

```
    POST Request:
        {
                	"subscription_type_id" : 2 , [id number]
                	"token": "477BBA133C182267FE5F086924ABDC5DB71F77BFC27F01F2843F2CDC69D89F05" [card token]
                	
                }
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "result": "Оплата успешно проведена",
        "success": true
    }
```

### Запрос на удаление карты
#### URL: https://tensend.me/api/v1/delete/card/{card_id}

```
    POST Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "result": "Карта успешно удалена",
        "success": true
    }
```

### Запрос на удаление карты
#### URL: https://tensend.me/api/v1/delete/card/{card_id}

```
    POST Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "result": "Карта успешно удалена",
        "success": true
    }
```

### Сгенерировать PROMO-CODE
#### URL: https://tensend.me/api/v1/profile/promo-code

```
    GET Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "link": "https://tensend.me/promo-codes/TS-Test-PY4L2B",
        "success": true
    }
```

### Все уровни
#### URL: https://tensend.me/api/v1/levels

```
    GET Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
   {
       "levels": [
           {
               "id": 1,
               "name": "Start Level",
               "start_count": 0,
               "end_count": 10,
               "discount_percentage": 10,
               "created_at": null,
               "updated_at": "2020-03-10 15:24:22",
               "period_date": 21,
               "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
               "description": "Lorem ipsum something like that cool level is starting to your tensend life is better that you wtf i am typing in. this description i don't know;"
           }
       ],
       "success": true
   }
```

### Начать курс
#### URL: https://tensend.me/api/v1/courses/start/{id}

```
    Post Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "message": "Урок уже начат",        
        "success": true
    }
    {
        "message": "Урок успешно начат",        
        "success": true
    }
```
### Запрос рейтинг пользователей
#### URL: https://tensend.me/api/v1/evaluate/rating

```
     GET Request
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
    {
        "ratings": [
            {
                "id": 42,
                "name": "Ysmaiyl Bokeikhan",
                "surname": null,
                "father_name": null,
                "image_path": "images/avatars/158168087467c2ad10-7f74-4ae9-953f-284a9674e7fbтест.jpg",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 1
            },
            {
                "id": 40,
                "name": "test",
                "surname": null,
                "father_name": null,
                "image_path": "images/avatars/158168087467c2ad10-7f74-4ae9-953f-284a9674e7fbтест.jpg",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 1
            },
            {
                "id": 46,
                "name": "test",
                "surname": null,
                "father_name": null,
                "image_path": "images/avatars/158168087467c2ad10-7f74-4ae9-953f-284a9674e7fbтест.jpg",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 0
            },
            {
                "id": 45,
                "name": "Bekzat",
                "surname": null,
                "father_name": null,
                "image_path": "images/avatars/158168087467c2ad10-7f74-4ae9-953f-284a9674e7fbтест.jpg",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 0
            },
            {
                "id": 61,
                "name": "test",
                "surname": null,
                "father_name": null,
                "image_path": "images/user-default.png",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 0
            },
            {
                "id": 12,
                "name": "test",
                "surname": null,
                "father_name": null,
                "image_path": "images/avatars/158168087467c2ad10-7f74-4ae9-953f-284a9674e7fbтест.jpg",
                "level_id": 1,
                "logo": "images/levels/158089602632cb8339-635c-4207-99d2-5be68579717fтест.jpg",
                "rating": 0, // Рейтинг юзера
            }
        ],
        "success": true
    }
```


### Сброс пароля авторизованным человеком
#### URL: https://tensend.me/api/v1/reset/password

```
    Post Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    REQUEST:
    {
    	"password" : "password123", //ТЕКУЩИЙ ПАРОЛЬ
    	"new_password" : "password"
    }
    
    RESPONSE:
    
    {
        "message": "Password updated",
        "success": true
    }
```

### Cертификат
#### URL: https://tensend.me/api/v1/courses/certificate/{id} course id

```
    GET Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA
    WebView
```

### Мои сертификаты
#### URL: https://tensend.me/api/v1/profile/certificates

```
    GET Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
   {
       "certificates": [
           {
               "id": 1,
               "title": "bekza",
               "lessons_count": 1,
               "image_path": "images/courses/1583925787b02350a9-1af8-4c59-919b-5337dae08a80Снимок экрана 2020-03-11 в 16.35.50.png",
               "author": {
                   "id": 2,
                   "name": "test",
                   "surname": "Test",
                   "father_name": null
               }
           }
       ],
       "success": true
   }
```

### Мои маркетинговые материалы / ПРИ НАЖАТИИ НА МАТЕРИАЛ ОТКРЫВАЕТСЯ В ВЕБ ВЬЮ ЧЕРЕЗ URL параметр в ответе
#### URL: https://tensend.me/api/v1/profile/marketing-materials

```
    GET Request:
        
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA

    RESPONSE:
   {
       "materials": [
           {
               "id": 1,
               "name": "TEST",
               "image_path": "images/marketing-materials/15844731257230bb1c-8126-4438-9a66-1155967dbcc1img.jpg",
               "url": "https://tensend.me/",
               "created_at": "2020-03-18 01:25:25",
               "updated_at": "2020-03-18 01:25:25"
           }
       ],
       "success": true
   }
```


### Получить FAQ
#### URL: https://tensend.me/api/v1/faqs

```
    GET Request:
        
    RESPONSE:
   {
       "faqs": [
           {
               "id": 1,
               "question": "Қалай сатып алу керек?",
               "answer": "Сабақ карап жатқан кезде, көз алдыңызда құлып пайда болады. Сол құлыпты бассаңыз, сізден сатып алу белгісі шығады.",
               "image_path": "/faqs/1584535904.png",
               "deleted_at": null,
               "created_at": "2020-03-18 18:51:44",
               "updated_at": "2020-03-18 18:51:44"
           },
           {
               "id": 2,
               "question": "Видео ұзақ ашылмайды",
               "answer": "Өтінеміз, интернет желісіне қосылуыңызды тексеріңіз",
               "image_path": "/news/default.png",
               "deleted_at": null,
               "created_at": "2020-03-18 18:53:07",
               "updated_at": "2020-03-18 18:53:07"
           }
       ],
       "success": true
   }
```


### Получить About Tensend
#### URL: https://tensend.me/api/v1/about/tensend

```
    GET Request:
        
    RESPONSE:
{
    "url": "https://tensend.me/#features-section",
    "success": true
}
```

### Получить About Tensend V2
#### URL: https://tensend.me/api/v1/about/app

```
    GET Request:
        
    RESPONSE:
{
    "tensend": {
        "about_us": "Test tesipsum lorem",
        "title": "Tensend",
        "address": "",
        "phone": "",
        "copyright": "",
        "img_path": "tensend.png",
        "links": []
    },
    "success": true
}
```

