<?php
use JetBrains\PhpStorm\Pure;

/**
 * Функция валидации email
 * - проверка на корректность email
 * - проверка на наличие email в базе данных
 * - проверка на пустоту
 * @param string $email
 * @param mysqli $db
 * @return string|bool
 */
function validateEmail(string $email, mysqli $db): string|bool
{
    $post_email = xssAdg($email);
    $result = $db->query("SELECT email FROM users WHERE email LIKE '%" . $post_email . "%'");
    if (filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL) === false) {
        return "Введите корректный email";
    }
    if ($result->num_rows > 0) {
        return "Пользователь с таким email уже зарегистрирован";
    }
    return false;
}
    
/**
 * Валидация пароля
 * - пароль должен быть не меньше 6 символов, состоящих из букв и цифр
 * - пароль не может быть пустым
 * @param string $pass
 * @return string|bool
 */
function validatePassword(string $pass):string|bool
{
    $preg_pass = "/^([0-9a-z]{6,})$/i";
    $post_pass = xssAdg($pass);
    if (preg_match($preg_pass, $post_pass) === 0) {
        return "Пароль должен содержать не меньше 6 букв и цифр";
    }
    return false;
}
    
/**
 * Функция проверки на отсутствие категорий.
 * @param string $category
 * @return string|bool
 */
#[Pure] function validateCategory(string $category):string|bool
{
    $post_category = xssAdg($category) ;
    if ($post_category === false) {
        return "Выберите категорию";
    }
    return false;
}

/**
 * Функция валидация числа
 * - проверка на символы числа, слова не допустимы
 * - число должно быть больше ноля
 * - число не может быть пустым
 * @param string $num
 * @param string $field
 * @return string|bool
 */
function validateNumber(string $num, string $field):string|bool
{
    if (is_numeric($num) === false && !empty($num)) {
        return "Введите число";
    }
    if (floatval($num) <= 0 && $num !== '') {
        return "$field должна быть больше ноля";
    }
    return false;
}
    
/**
 *  Функция валидация ставки.
 * - ставка может быть только числом не меньше ноля
 * - проверка на пустоту
 * @param string $step
 * @return string|bool
 */
#[Pure] function validateStep(string $step):string|bool
{
    $post_step = xssAdg($step) ;
    if ($post_step !== false) {
        return validateNumber($post_step, 'Ставка');
    }
    return false;
}
    
/**
 * Функция валидация цены.
 * - начальная цена может быть только числом не меньше ноля
 * - запятая в числах с плавающей точкой преобразуется в точку
 * - проверка на пустоту
 * @param string $price
 * @return string|bool
 */
function validatePrice(string $price):string|bool
{
    $post_price = xssAdg($price) ;
    if ($post_price !== false) {
        $post_number = str_replace(',', '.', $post_price);
        return validateNumber($post_number, 'Цена');
    }
    return false;
}
    
/**
 * Функция валидация даты.
 * - корректность формата даты - дата должна быть формата "ГГГГ-MM-ДД".
 * - дата не может быть прошлым или текущим днём.
 * - дата не может быть пустой
 * @param string $date
 * @return string|bool
 */
function validateDate(string $date):string|bool
{
    $post_date = xssAdg($date);
    if ($post_date !==  false) {
        $date_time_obj = DateTime::createFromFormat('Y-m-d', $post_date);
        $date_days_validate = new DateTime('+1 days');
        $date_pattern_validate = '#^([0-9]{4}[-/]?((0[13-9]|1[012])[-/]'.
                        '?(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])[-/]'.
                        '?31|02[-/]?(0[1-9]|1[0-9]|2[0-8]))|([0-9]{2}'.
                        '(([2468][048]|[02468][48])|[13579][26])|([13579][26]|[02468][048])00)[-/]'.
                        '?02[-/]?29)$#';
        if (preg_match($date_pattern_validate, $post_date) === 0) {
            return "Укажите дату в формате 'ГГГГ-MM-ДД'";
        }
        if ($date_time_obj < $date_days_validate) {
            return "Дата должна быть больше текущей даты, хотя бы на один день'";
        }
    }
    return false;
}
    
/**
 * Функция валидации длины символов,
 * также происходит проверка на пустоту.
 * @param string $title
 * @param int $min
 * @param int $max
 * @return string|bool
 */
#[Pure] function validateLength(string $title, int $min, int $max):string|bool
{
    $title = xssAdg($title) ;
    $len = strlen($title);
    if ($len < $min || $len > $max) {
        return "Значение должно быть от $min до $max символов";
    }
    return false;
}

/**
 * Функция валидация файла.
 * - по mime-типу
 * - по размеру
 * - по пустоте
 * @return string|bool
 */
function validateFile():string|bool
{
    $file_title = $_FILES['lot-img']['name'];
    $file_tmp_title = $_FILES['lot-img']['tmp_name'];
    $file_size = $_FILES['lot-img']['size'];
    if (!empty($file_title)) {
        $mime_type = mime_content_type($file_tmp_title);
        if ($mime_type !== 'image/png' && $mime_type !== 'image/jpeg') {
            return "Добавьте картинку jpeg, png, jpg";
        }
        if ($file_size > 1000000) {
            return "Максимальный размер файла: 1МБ";
        }
    }
    return false;
}
