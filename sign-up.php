<?php
require_once('bootstrap.php');

$dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$errors = [];
$categories = get_all_categories($dbase);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rules = [
        'email' => static function () use ($dbase) {
            return validateEmail('email', $dbase);
        },
        'password' => static function () {
            return validatePassword('password');
        },
    ];
}

foreach ($_POST as $key => $value) {
    if (isset($rules[$key])) {
        $rule = $rules[$key];
        $errors[$key] = $rule();
    }
    if ($value === '') {
        $errors[$key] = 'Это поле должно быть заполнено';
    }
}

$errors = array_filter($errors);
submitFormSignUp($errors, $dbase);

$registration = include_template('sign-up.php', compact('categories', 'errors'));
$layout_content = include_template('layout.php', [
    'content' => $registration,
    'title' => 'Регистрация',
    'is_auth' => IS_AUTH,
    'user_name' => USER_NAME,
    'categories' => $categories,
]);

print($layout_content);
