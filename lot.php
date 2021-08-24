<?php
    require_once('bootstrap.php');
    $is_auth = rand(0, 1);
    $user_name = 'Виталий';
    $dbase = get_db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $lot = get_lot($dbase, (int)$_GET['id']);

    if (!$lot) {
        http_response_code(404);
        header('Location: /404.php');
    }

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
