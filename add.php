<?php
require_once('bootstrap.php');

$dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$errors = [];
$categories = get_all_categories($dbase);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rules = [
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
            return validateLength('message', 20, 3000);
        },
    ];
 
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
        if ($value === '') {
            $errors[$key] = 'Это поле должно быть заполнено';
        }
    }
    
    $file_error = validateFile();
    if ($file_error !== false) {
        $errors['lot-img'] = $file_error;
    }
    if ($_FILES['lot-img']['error'] === 4) {
        $errors['lot-img'] = 'Добавьте изображение';
    }
    $errors = array_filter($errors);
}

submitFormAddLot($errors, $dbase);

$add_lot = include_template('add-lot.php', compact('categories', 'errors'));
$layout_content = include_template('layout.php', [
    'content' => $add_lot,
    'title' => 'Добавление лота',
    'is_auth' => IS_AUTH,
    'user_name' => USER_NAME,
    'categories' => $categories,
]);
    
print($layout_content);
