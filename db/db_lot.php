<?php
    /**
     * @param mysqli $db
     * @param string $id Получаем $_GET['id'] лота
     * @return array|null
     */

function get_lot(mysqli $db, string $id): ?array
{
    $query_lot = 'SELECT l.id AS id, l.title AS title, l.price AS price, l.start_price AS start_price, l.img AS img, l.description AS description, l.created_at AS created_at,  l.completed_at AS completed_at, c.title AS category_title FROM lots AS l INNER JOIN categories AS c ON l.category_id = c.id WHERE l.id = ?';
    $stmt = $db->prepare($query_lot);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result_lot = $stmt->get_result();
    return $result_lot?->fetch_array(MYSQLI_ASSOC);
}
