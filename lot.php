<?php

require_once('bootstrap.php');
$is_auth = rand(0, 1);
$user_name = 'Виталий';
$lot = get_lot($dbase, $_GET['id']);
$categories = get_all_categories($dbase);
$lot_main = include_template('lot-main.php', compact('categories', 'lot'));
$layout_content = include_template(
    'layout.php',
    [
        'content' => $lot_main,
        'title' => 'Лот',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'categories' => $categories
    ]
);

print($layout_content);
