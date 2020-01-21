# Для поднятия локально

Запускаем контейнеры:

```
docker-compose up
```

Создаём файл настроек окружения

```
cd pixels
cp .env.example .env
```

В контейнере с MySQL создаём базу.

```
docker-compose exec mysql mysql
CREATE DATABASE pixels
```

В контейнере с PHP устанавливаем зависимости.

```
docker-compose exec web bash
composer install
php artisan key:generate
php artisan migrate
```

В контейнере с PHP накатываем сиды .

```
php artisan db:seed
cp -R resources/assets/ storage/app/logo/
```

Для того, чтобы заработали картинки, линкуем сторадж в паблик.

```
php artisan logo:link
```

## Сборка стилей и скриптов

```bash
cd pixels
npm i
npm run watch
```

Адрес сайта: `localhost`.

Тестовый пользователь: 
``
admin@test.loc / password
``
