## Simple Live Video Platform

Программа позволяет публиковать видеотрансляции в Интернете или внутренней сети по протоколу HLS.
Используется nginx c nginx-rtmp-module, apache2, php, mariadb, фреймворк Laravel.

Для каждого пользователя программой ведется лицевой счёт по каждому поставщику контента, можно организовать платные и бесплатные трансляции.
Видеоданные принимаются по протоколу RTMP, а передаются к конечному пользователю по HLS.
Присутствует функция записей трансляций. Программа для каждой трансляции создаёт уникальный токен, известный поставщику контента, таким образом, именно он от своего имени размещает контент. Имеется веб-интерфейс (шаблоны Blade) и используется Livewire для динамического обновления данных.

## Краткая инструкция:
Установите нужные пакеты: apache2, nginx, nginx-rtmp-module, mariadb-server, php.
Создайте пользователя и базу данных на mariadb-server.
Укажите домены в /etc/hosts по образцу в файле hosts_example

Скачайте проект, выполнив команду
- git clone https://github.com/itnomad01/slvp.git

настройте сервер Apache2 по образцу в папке apacheconfig
настройте сервер nginx по образцу в папке nginxconfig

Папка webapp должны быть DocumentRoot для вашего виртуального хоста.
В этой папке обновите зависимости:
- composer update
- npm install

Затем соберите фронтенд командой 
- npm run dev

или
- npm run prod

Через php artisan создайте новый ключ приложения.
Создайте файл настроек .env по образцу .env.example

Создайте пароли для пользователей в файле database/seeders/UserSeeder.php

Выполните миграции и первичное наполнение база данных
- php artisan migrate:fresh --seed

Создайте службу для выполнения заданий в очередях по образцу в файле unit_example

перезапустите все затронутые службы для применения изменений.
Зайдите в SLVP через браузер и создайте свою первую трансляцию.