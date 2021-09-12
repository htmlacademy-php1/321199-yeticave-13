<?php
require_once('bootstrap.php');

$dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$lot = get_lot($dbase, (int)$_GET['id']);
$categories = get_all_categories($dbase);

if ($lot === null) {
    http_response_code(404);
    header('Location: /404.php');
}

$lot_main = include_template('lot-main.php', compact('categories', 'lot'));
$layout_content = include_template(
    'layout.php',
    [
        'content' => $lot_main,
        'title' => 'Лот',
        'is_auth' => IS_AUTH,
        'user_name' => USER_NAME,
        'categories' => $categories
    ]
);

print($layout_content);
