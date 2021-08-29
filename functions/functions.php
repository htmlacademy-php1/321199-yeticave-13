<?php
    /**
     * Функция защиты от xss-атак
     * @param string $e
     * @return string
     */

    function xssAdg(string $e): string
    {
        return htmlspecialchars($e);
    }

    /**
     * Функция возврата значения input
     * c защитой от xss-атак
     * @param string $name
     * @return mixed|string
     */
    function getPostVal(string $name): string
    {
        return xssAdg($_POST[$name] ?? "");
    }

    /** Функция загрузки файла */
    function uploadFile()
    {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . FOLDER_IMG;
        move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . IMG_TITLE);
    }
