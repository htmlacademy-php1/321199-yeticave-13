<?php

    require_once('helpers.php');
    require_once('db.php');
    require_once('functions.php');

    $is_auth = rand(0, 1);
    $user_name = 'Виталий';

    $main = include_template('main.php', compact('categories', 'advertisement'));

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
