### Подготовка .env
Файл ```.env.example``` скопировать в ```.env```
### Подготовка hosts
Из-под root-а (желательно, в отдельном терминале, но можно сменить пользователя на обычного после выполнения):

в файле /etc/hosts добавить  строку
```127.0.0.1 landing.local```
## Докер
### Сборка
При сборке образа передать ему текущую группу и пользователя 
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose build
```
Возможная ошибка:
```
OSError: Can not read file in context: .../landing/docker/mysql_8/db/mysql.sock.lock
```
Тогда удалить mysql.sock.lock

### Запуск
Запуск
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose up
```

### Остановка
Останавливать лучше так же
```
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose down
```
### Сборка проекта менеджерами после запуска контейнеров (хотя бы один раз после клонирования из репозитория)
#### composer 
Разрешить зависимости (в контейнере php)
```
composer install
```
#### Подсказки для среды разработки (необязательно)
Для использования `barryvdh/laravel-ide-helper` выполнить внутри контейнера
```
php artisan ide-helper:generate
```
#### js и css
На prod среде нет webpack сборки, поэтому в git загружаются готовые файлы js и css

Для работы с ```js``` и ```css``` файлами (при их изменении):

Разрешить зависимости (в контейнере nodejs). Один раз, при первом запуске проекта после сборки проекта
```
npm install
```

После каждого изменения js и css 
```
npm run prod
```

## https на локальной машине (самоподписанный)
https работает для адреса landing.local (указанный в файле hosts). Поставить в браузер сертификат из ./nginx/cert/server.crt
(в chrome: настройки -> в левом меню конфиденциальность и безопасность -> Безопасность -> Настроить сертификаты -> вкладка Центры сертификации -> кнопка Импорт)

## Начало работы в админке 
Для начала работы нужно программно создать пользователя, например добавив в ```/routes/web.php```
после ```Auth::routes();```
следующий код
```
Route::get('create-local-admin', function(){
    $user = new \App\User();
    $user->password = \Illuminate\Support\Facades\Hash::make('localadmin');
    $user->name = 'localadmin';
    $user->email = 'localadmin@cdek.ru';
    $user->save();
    dd('Создан');
});
```
и открыть в браузере ```http://landing.local/create-local-admin```

**Ни в коем случае не выкладывать этот код в git и на сервер!!!**

Удалить этот код.

Админка по адресу ```http://landing.local```

## Копирование данных с prod среды
Развернуть дамп и скопировать папку ```./storage/app```
