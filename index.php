<?php

    require_once( 'helpers.php' );
    require_once( 'functions.php' );

    $is_auth = rand( 0, 1 );
    $user_name = 'Виталий';

    $db = new mysqli( '', '', '', '' );
    $db -> set_charset( 'utf8' );

    if ( $db -> connect_errno ) {
        exit( 'Ошибка не удалось подключиться к базе данных. Повторите попытку' );
    } else {
        $sql_lots = 'SELECT l.title AS title, l.price AS price, l.start_price AS start_price, l.img AS img, l.created_at AS created_at,  l.completed_at AS completed_at, c.title AS catagory_title FROM lots AS l INNER JOIN categories AS c ON l.category_id = c.id ORDER BY l.created_at DESC LIMIT 6';
        $sql_categories = 'SELECT title, code FROM categories ORDER BY created_at DESC';
        $result_lots = $db -> query( $sql_lots );
        $result_categories = $db -> query( $sql_categories );

        if ( !$result_lots && !$result_categories ) {
            $error = $db -> error;
            exit( 'Ошибка MySQL: ' . $error );
        }

        $lots = $result_lots -> fetch_all( MYSQLI_ASSOC );
        $categories = $result_categories -> fetch_all( MYSQLI_ASSOC );
    }

    $main = include_template( 'main.php', compact( 'categories', 'lots' ) );

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

    print( $layout_content );
