### Включение очереди
```
1. composer install
2. установить очередь поставить пароль для очереди

3. .ENV - changes

QUEUE_CONNECTION=redis

QUEUE_DRIVER=redis
REDIS_HOST=0.0.0.0
REDIS_PASSWORD=password // тут мой пароль
REDIS_PORT=6379
REDIS_PREFIX=tensend_
REDIS_CLIENT=predis

4. Для запуска уоркера локально

php artisan queue:listen --queue=notifications

5. На серваке стоит supervisor
очередь включается через нее

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
 
сам файл конфигурацц находится 
на серваке по пути

/etc/supervisor/conf.d/

```
