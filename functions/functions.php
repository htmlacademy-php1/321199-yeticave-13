<?php
use JetBrains\PhpStorm\Pure;
    
/**
 * Функция защиты от xss-атак
 * @param string $e
 * @return string|false
 */
function xssAdg(string $e): string|false
{
    if (isset($_POST[$e])) {
        return htmlspecialchars($_POST[$e]);
    }
    return  false;
}

    /** Функция загрузки файла
     * @param string $title
     * @return bool
     */
function uploadFile(string $title): bool
{
    if ($_FILES[$title]['name'] !== null) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . FOLDER_IMG;
        move_uploaded_file($_FILES[$title]['tmp_name'], $file_path . IMG_TITLE);
    }
    return false;
}

/**
 * Функция добавления лота через форму
 *
 * Если форма прошла валидацию
 * добавляет лот в базу данных
 * и перенаправляет на страницу добавленного лота
 * @param array $errors
 * @param mysqli $dbase
 * @return bool
 */
function submitFormAddLot(array $errors, mysqli $dbase): bool
{
    if (empty($errors)) {
        $stmt_result = add_lot($dbase, IMG_TITLE);
        if ($stmt_result !== false) {
            uploadFile('lot-img');
            $new_lot_id = $dbase->insert_id;
            header("Location: " . create_url(PAGE_LOT_URL, ['id' => $new_lot_id]));
        }
    }
    return false;
}
    
    /**
     * Функция отправки формы регистрации
     *
     * Если форма прошла валидацию
     * добавляет пользователя в базу данных
     * и перенаправляет на страницу входа
     * @param array $errors
     * @param mysqli $dbase
     * @return false
     */
function submitFormSignUp(array $errors, mysqli $dbase): bool
{
    if (empty($errors)) {
        $stmt_result = add_user($dbase);
        if ($stmt_result !== false) {
            header("Location:" . PAGE_SIGN_IN_URL);
        }
    }
    return false;
}
