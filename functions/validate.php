<?php

    /**
     * Функия проверки корректности email
     * @param string $name
     * @return string|void
     */
    function validateEmail(string $name)
    {
        if (!filter_input(INPUT_POST, $name, FILTER_VALIDATE_EMAIL)) {
            return "Введите корректный email";
        }
    }

    /**
     * Функция проверки на отстутсвие категорий.
     * @param string $name
     * @return string|void
     */
    function validateCategory(string $name)
    {
        if (!$_POST[$name]) {
            return "Выберите категорию";
        }
    }

    /**
     * Функция проверки поля на пустоту
     * @param string $name
     * @return string|void
     */
    function validateEmpty(string $name)
    {
        if (!$_POST[$name]) {
            return "Это поле должно быть заполнено";
        }
    }

    /**
     * Функция валидация числа
     * - Проверка на символы числа, слова не допустимы
     * - число должно быть больше ноля
     * - число не может быть пустым
     * @param string $name
     * @param string $num
     * @param string $field
     * @return string|void
     */
    function validateNumber(string $name, string $num, string $field)
    {
        if ((!is_numeric($num) && !empty($num))) {
            return "Введите число";
        }
        if (floatval($num) <= 0 && $num !== '') {
            return "$field должна быть больше ноля";
        }
        return validateEmpty($name);
    }

    /**
     *  Функция валидация ставки.
     * - ставка может быть только числом не меньше ноля
     * - проверка на пустоту
     * @param string $name
     * @return string|void
     */
    function validateStep(string $name)
    {
        $post_number = $_POST[$name] ?? '';
        return validateNumber($name, $post_number, 'Ставка');
    }

    /**
     * Функция валидация цены.
     * - начальная цена может быть только числом не меньше ноля
     * - запятая в числах с плвающей точкой преобразуется в точку
     * - проверка на пустоту
     * @param string $name
     * @return string|void
     */
    function validatePrice(string $name)
    {
        $post_number = str_replace(',', '.', $_POST[$name] ?? '');
        return validateNumber($name, $post_number, 'Цена');
    }

    /**
     * Функция валидация даты.
     * - корректность формата даты - дата должна быть формарта "ГГГГ-MM-ДД".
     * - дата не может быть прошлым или текущим днём.
     * - дата не может быть пустой
     * @param string $date
     * @return string|void
     */
    function validateDate(string $date)
    {
        $post_date = $_POST[$date];
        if ($post_date) {
            $date_time_obj = DateTime::createFromFormat('Y-m-d', $post_date);
            $date_valide = new DateTime('+1 days');
            $date_time_format = $date_time_obj->format('Y-m-d');
            $date_valide_format = $date_valide->format('Y-m-d');
            if ($date_time_format !== $post_date) {
                return "Укажите дату в формате 'ГГГГ-MM-ДД'";
            }
            if ($date_time_format < $date_valide_format) {
                return "Дата должна быть больше текущей даты, хотя бы на один день'";
            }
        }
        return validateEmpty($date);
    }

    /**
     * Функция валидации допустимости длины,
     * также происходит проверка на пустоту.
     * @param string $name
     * @param int $min
     * @param int $max
     * @return string|void
     */
    function isCorrectLength(string $name, int $min, int $max)
    {
        $text = xssAdg($_POST[$name]);
        $len = strlen($text);
        if ($len == 0) {
            return validateEmpty($name);
        }
        if ($len < $min || $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }

    /**
     * Функция валидация файла.
     * - по mime-типу,
     * - по размеру
     * - по пустоте
     * @return string|void
     */
    function validateFile()
    {
        if (!empty($_FILES['lot-img']['name'])) {
            $mime_type = mime_content_type($_FILES['lot-img']['tmp_name']);
            if ($mime_type !== 'image/png' && $mime_type !== 'image/jpeg') {
                return "Добавьте картинку jpeg, png, jpg";
            }
            if ($_FILES['lot-img']['size'] > 1000000) {
                return "Максимальный размер файла: 1МБ";
            }
        } else {
            return "Добавьте картинку";
        }
    }



