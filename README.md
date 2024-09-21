# product-catalog-system

## О проекте

API для управления каталогом продуктов в магазине.

## Установка

1. Клонируйте репозиторий: `git clone https://github.com/Dan-Bukh/product-catalog-system`
2. Скопируйте файл `.env.example` и переименуйте его в `.env`: `cp .env.example .env`
3. Перейдите в директорию проекта: `cd product-catalog-system/vendor/bin`
4. Запустите контейнеры: `./sail up`
5. Сгенерируйте ключ: `./sail artisan key:generate`
5. Установите базу данных и выполните миграции: `./sail artisan migrate --seed`

## Использование

1. Перейдите на адрес: `http://localhost:8000`
2. В Postman установить логин и пароль для Auth.Basic: 
`login: test@example.com | password: 123 - admin`
`login: test2@example.com | password: 123 - user`  

## Документация API

#### GET /products

Возвращает список всех продуктов

##### Параметры
* `search` - (опционально) поисковый запрос
* `category_id` - (опционально) id категории
* `orderBy` - (опционально) сортировка по полю (price)
* `page` - (опционально) номер страницы
* `per_page` - (опционально) количество элементов на странице

#### GET /products/{id}

Возвращает продукт по id

#### POST /products

Создает новый продукт

##### Параметры
* `name` - имя продукта
* `description` - описание продукта
* `price` - цена продукта
* `category_id` - id категории


#### PUT /products/{id}

Обновляет продукт

##### Параметры
* `name` - имя продукта
* `description` - описание продукта
* `price` - цена продукта
* `category_id` - id категории


#### DELETE /products/{id}

Удаляет продукт
