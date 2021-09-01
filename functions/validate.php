<?php

    /**
     * Функция валидации email
     * - проверка на корректность email
     * - проверка на наличие email в базе данных
     * - проверка на пустоту
     * @param string $email
     * @return string|void
     */
    function validateEmail(string $email, mysqli $db)
    {
        if (empty($_POST[$email])) {
            return validateEmpty($email, "Укажите вашу почту");
        }
        if (!filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL)) {
            return "Введите корректный email";
        }
        $result = $db->query("SELECT email FROM users WHERE email LIKE '%" . $_POST[$email] . "%'");
        if ($result->num_rows > 0) {
            return "Пользователь с таким email уже зарегестрирован";
        }
    }

    /**
     * Валидация пароля
     * - пароль должен быть не меньше 6 символов, состоящих из букв и цифр
     * - пароль не может быть пустым
     * @param $pass
     * @return string|void
     */
    function validatePassword($pass)
    {
        $preg_pass = "/^([0-9a-z]{6,})$/i";
        if (empty($_POST[$pass])) {
            return validateEmpty($pass, 'Придумайте пароль');
        }
        if (!preg_match($preg_pass, $_POST[$pass])) {
            return "Пароль должен содержать не меньше 6 букв и цифр";
        }
    }

    /**
     * Функция проверки на отсутствие категорий.
     * @param string $category
     * @return string|void
     */
    function validateCategory(string $category)
    {
        if (!$_POST[$category]) {
            return "Выберите категорию";
        }
    }

    /**
     * Функция проверки поля на пустоту
     * @param string $title
     * @return string|void
     */
    function validateEmpty(string $title, $text = "Это поле должно быть заполнено")
    {
        if (!$_POST[$title]) {
            return $text;
        }
    }

    /**
     * Функция валидация числа
     * - проверка на символы числа, слова не допустимы
     * - число должно быть больше ноля
     * - число не может быть пустым
     * @param string $title
     * @param string $num
     * @param string $field
     * @return string|void
     */
    function validateNumber(string $title, string $num, string $field)
    {
        if ((!is_numeric($num) && !empty($num))) {
            return "Введите число";
        }
        if (floatval($num) <= 0 && $num !== '') {
            return "$field должна быть больше ноля";
        }
        return validateEmpty($title);
    }

    /**
     *  Функция валидация ставки.
     * - ставка может быть только числом не меньше ноля
     * - проверка на пустоту
     * @param string $bet
     * @return string|void
     */
    function validateStep(string $bet)
    {
        $post_number = $_POST[$bet] ?? '';
        return validateNumber($bet, $post_number, 'Ставка');
    }

    /**
     * Функция валидация цены.
     * - начальная цена может быть только числом не меньше ноля
     * - запятая в числах с плвающей точкой преобразуется в точку
     * - проверка на пустоту
     * @param string $price
     * @return string|void
     */
    function validatePrice(string $price)
    {
        $post_number = str_replace(',', '.', $_POST[$price] ?? '');
        return validateNumber($price, $post_number, 'Цена');
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
     * Функция валидации длины символов,
     * также происходит проверка на пустоту.
     * @param string $title
     * @param int $min
     * @param int $max
     * @return string|void
     */
    function validateLength(string $title, int $min, int $max)
    {
        $text = xssAdg($_POST[$title]);
        $len = strlen($text);
        if ($len == 0) {
            return validateEmpty($title);
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



