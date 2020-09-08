
В контейнере php нужно перейти в директорию `/app`
```
cd /app
```
Разрешить зависимости (в контейнере php)
```
composer install
```
Для использования `barryvdh/laravel-ide-helper` выполнить внутри контейнера
```
php artisan ide-helper:generate
```
