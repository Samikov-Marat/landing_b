При сборке образа передать ему текущую группу и пользователя 
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose build
```
Возможная ошибка:
```
OSError: Can not read file in context: .../landing/docker/mysql_8/db/mysql.sock.lock
```
Тогда удалить mysql.sock.lock

Запуск
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose up
```


Останавливать лучше так же
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose down
```

Разрешить зависимости (в контейнере php)
```
composer install
```
Для использования `barryvdh/laravel-ide-helper` выполнить внутри контейнера
```
php artisan ide-helper:generate
```

https работает для адреса landing.local (через файл hosts)


Для работы с ```js``` и ```css``` файлами:

Разрешить зависимости (в контейнере nodejs). Один раз, при первом запуске проекта после сборки проекта
```
npm install
```
