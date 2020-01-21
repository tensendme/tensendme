# <h1>Tensend Project</h1>

### BAD TEAM

### API BASE URL: https://tensend.me/api/v1/
### FIREBASE ACCOOUNT
email: tensend.me@gmail.com 
<br>
password: tensendme2020n
<hr/>

<h3>Примечание: знак ' || ' значит ИЛИ</h3>

###Авторизация:
####URL: https://tensend.me/api/v1/login
#####Токен передается через HEADER: Authorization => Bearer Token
````
    Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvdGVuc2VuZC5tZVwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE1Nzk2MjcxNjYsImV4cCI6MTU3OTYzMDc2NiwibmJmIjoxNTc5NjI3MTY2LCJqdGkiOiJPeUg5T3hZcVY2d0d6QllyIiwic3ViIjoxLCJwcnYiOiJlZTVhYzY5NDI5YzU1NmQ3NWRiZTdmZjRlNThiOTdjZDRmNzE0MmViIn0.Ykb0nBteVz3KBVmfxAcPHtgA9JPyfD3CArwSL4P3onA
````
ПО EMAIL:

```
    POST Request:
    {
    	"email" : "admin@mail.ru",
    	"password" : "password"
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

###Отправка проверочного кода:
####URL: https://tensend.me/api/v1/code/send

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
###Проверка кода
####URL: https://tensend.me/api/v1/code/check

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

###Сбросить пароль
####URL: https://tensend.me/api/v1/code/reset
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

```
###Проверка логина на существование
####URL: https://tensend.me/api/v1/login/check

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
###Получение всех категорий (пагинировано)
####URL: https://tensend.me/api/v1/categories

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
###Получение всех медитаций (пагинировано)
####URL: https://tensend.me/api/v1/meditations

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
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null
                },
                {
                    "id" : 1,
                    "category_id" : 1,
                    "title" : "Test",
                    "description" : "Test",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null
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