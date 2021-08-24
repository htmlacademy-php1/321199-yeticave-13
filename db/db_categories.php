<?php

/**
 * @param $db mysqli
 * @return array Возвращаем массив с категориями
 */
function get_all_categories(mysqli $db): array
{
    $sql_categories = 'SELECT title, code FROM categories ORDER BY created_at DESC';
    $result_categories = $db->query($sql_categories);
    return $result_categories->fetch_all(MYSQLI_ASSOC);
}

