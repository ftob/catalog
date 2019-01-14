Каталог товаров
==================


**Требования**

    • Получение списка всех категорий
    • Получение списка товаров в конкретной категории
    • Авторизация пользователей
    • Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
    • Добавление/Редактирование/Удаление товара (для авторизованных пользователей)
    


0. Установка <br>
    А. Docker-compose: <br> 
    ```docker build && docker-compose up -d```<br>
    B. Developer environment <br>
    ```sudo apt-get install postgresql``` <br>
    ```cp .env.example .env php artisan serve``` <br>
    C. LNPP ubuntu <br>
    ``` sudo apt install nginx ``` <br>
    ``` sudo apt install php71-fpm ``` <br>
    ``` sudo apt install postgresql-9.6 ``` <br>
    ``` sudo cp .docker/front/etc/sites-available/default.conf /etc/sites-available/default.conf``` <br>
    ``` sudo service nginx restart```
    

1. Получение списка всех категорий <br>
   ```curl http://localhost/api/categories``` Все категории <br>
   ```curl http://localhost/api/categories?with=items``` Все категории со всеми товарами
2. Получение списка товаров в конкретной категории
    ```http://localhost/api/items?with=categories&search=categories.name:%D0%92%20%D0%BA%D0%BB%D0%B5%D1%82%D0%BA%D1%83```
    ```http://localhost/api/itemssearch=categories.id:12```
3. Смотреть https://laravel.com/docs/5.7/passport и тесты ```php ./vendor/bin/phpunit tests/Feature/UserTest.php```

4. ...Смотреть тесты ```php ./vendor/bin/phpunit tests/Feature/CategoryTest.php```

5. ...Смотреть тесты ```php ./vendor/bin/phpunit tests/Feature/CategoryTest.php```


**Товарищ не забывай про сидеры!**




