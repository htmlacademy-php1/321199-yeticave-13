<?php
// Подключение к базе данных
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'yeticave';
// создаю уникальное имя для картинки
    define("IMG_TITLE", isset($_FILES['lot-img']['name']) ? uniqid() . $_FILES['lot-img']['name'] : '');
