<?php
    require_once('bootstrap.php');
    $is_auth = 1;
    $user_name = 'Виталий';
    $dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $errors = [];
    $categories = get_all_categories($dbase);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $rules = [
            'email' => static function () use ($dbase) {
                return validateEmail('email', $dbase);
            },
            'name' => static function () {
                return validateEmpty('name', "Введите имя");
            },
            'password' => static function () {
                return validatePassword('password');
            },
            'message' => static function () {
                return validateEmpty('message', "Напишите как с вами связаться");
            },
        ];
    }
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }
    $errors = array_filter($errors);
    submitFormSignUp($errors, $dbase);

    $registration = include_template('sign-up.php', compact('categories', 'errors'));
    $layout_content = include_template('layout.php', [
        'content' => $registration,
        'title' => 'Регистрация',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories,
    ]);

    print($layout_content);
