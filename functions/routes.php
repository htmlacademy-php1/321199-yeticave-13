<?php

// пути для ссылок

    // адрес, где лежать картинки
    const FOLDER_IMG = '/uploads/';
    // адрес страницы добавления лота
    const PAGE_ADD_LOT_URL = '/add.php';
    // адрес детальной страницы лота
    const PAGE_LOT_URL = '/lot.php';
    // адрес страницы ставок пользователя
    const PAGE_MY_BETS_URL = '/my-bets.php';
    // адрес страницы регистрации
    const PAGE_SIGN_UP_URL = '/sign-up.php';
    // адрес страницы входа
    const PAGE_SIGN_IN_URL = '/sign-in.php';

    /**
     * Функция создания ссылки
     *
     * принимает первым параметром адрес страницы,
     * вторым, необязательным параметром, принимает
     * массив из GET параметров адресной строки
     * @param string $url
     * @param array $params
     * @return string
     */
    function create_url(string $url, array $params = []): string
    {
        return (count($params) > 0) ? $url . '?' . $params[0] . '=' . $params[1] : $url;
    }
