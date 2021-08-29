<?php

    require_once('bootstrap.php');
    $is_auth = rand(0, 1);
    $user_name = 'Виталий';
    $errors = [];
    $dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $categories = get_all_categories($dbase);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $rules = [
            'lot-name' => static function () {
                return validateEmpty('lot-name');
            },
            'lot-rate' => static function () {
                return validatePrice('lot-rate');
            },
            'lot-step' => static function () {
                return validateStep('lot-step');
            },
            'category' => static function () {
                return validateCategory('category');
            },
            'lot-date' => static function () {
                return validateDate('lot-date');
            },
            'message' => static function () {
                return isCorrectLength('message', 20, 3000);
            },
        ];

        foreach ($_POST as $key => $value) {
            if (isset($rules[$key])) {
                $rule = $rules[$key];
                $errors[$key] = $rule();
            }
        }
        $file_error = validateFile();

        if ($file_error) {
            $errors['lot-img'] = $file_error;
        }

        $errors = array_filter($errors);

        if (!$errors) {
            $stmt_result = add_lot($dbase, IMG_TITLE);
            if ($stmt_result) {
                uploadFile();
                $new_lot_id = $dbase->insert_id;
                header("Location: /lot.php?id=" . $new_lot_id);
            }
        }
    }

    $add_lot = include_template('add-lot.php', compact('categories', 'errors'));
    $layout_content = include_template('layout.php', [
        'content' => $add_lot,
        'title' => 'Добавление лота',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories,
    ]);

    print($layout_content);
