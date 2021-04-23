При сборке образа передать ему текущую группу и пользователя 
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose build
```

Разрешить зависимости (в контейнере php)
```
composer install
```
Для использования `barryvdh/laravel-ide-helper` выполнить внутри контейнера
```
php artisan ide-helper:generate
```
