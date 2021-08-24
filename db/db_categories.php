<?php

/**
 * @param $db mysqli
 * @return array Возвращаем массив с категориями
 */
function get_all_categories(mysqli $db): array
{
    $query_categories = 'SELECT title, code FROM categories ORDER BY created_at DESC';
    $result_categories = $db->query($query_categories);
    return $result_categories->fetch_all(MYSQLI_ASSOC);
}

