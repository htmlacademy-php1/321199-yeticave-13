<?php

require_once('bootstrap.php');
$is_auth =0;
$user_name = 'Виталий';
$dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$lots = get_all_lots($dbase);
$categories = get_all_categories($dbase);
$main = include_template('main.php', compact('categories', 'lots'));

$layout_content = include_template(
    'layout.php',
    [
        'content' => $main,
        'title' => 'Главная',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories
    ]
);

print($layout_content);
