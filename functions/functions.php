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
     * @return string
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

    /**
     * Функция добавления лота через форму
     *
     * Если форма прошла валидацию
     * добавляет лот в базу данных
     * и перенаправляет на страницу добавленного лота
     * @param $errors
     * @param $dbase
     */
    function submitFormAddLot($errors, $dbase)
    {
        if (!$errors) {
            $stmt_result = add_lot($dbase, IMG_TITLE);
            if ($stmt_result) {
                uploadFile();
                $new_lot_id = $dbase->insert_id;
                header("Location: " . create_url(PAGE_LOT_URL, ['id', $new_lot_id]));
            }
        }
    }

    /**
     * Функция отправки формы регистрации
     *
     * Если форма прошла валидацию
     * добавляет пользователя в базу данных
     * и перенаправляет на страницу входа
     * @param $errors
     * @param $dbase
     */
    function submitFormSignUp($errors, $dbase)
    {
        if (!$errors) {
            $stmt_result = add_user($dbase);
            if ($stmt_result) {
                header("Location:" . PAGE_SIGN_IN_URL);
            }
        }
    }
