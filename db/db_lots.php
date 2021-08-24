<?php

/**
 * @param $db mysqli
 * @return array Возвращаем массив с лотами
 */
function get_all_lots(mysqli $db): array
{
    $query_lots = 'SELECT l.id AS id, l.title AS title, l.price AS price, l.start_price AS start_price, l.img AS img, l.created_at AS created_at,  l.completed_at AS completed_at, c.title AS category_title FROM lots AS l INNER JOIN categories AS c ON l.category_id = c.id ORDER BY l.created_at DESC LIMIT 6';
    $result_lots = $db->query($query_lots);
    return $result_lots->fetch_all(MYSQLI_ASSOC);
}
