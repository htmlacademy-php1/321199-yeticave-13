<?php
    
/**
     * Функция добавления лота в базу данных
     * @param mysqli $db
     * @param string $img_title
     * @return bool
     */
    
function add_lot(mysqli $db, string $img_title): bool
{
    $user_id = rand(0, 6);
    $post_lot_name = xssAdg('lot-name');
    $post_category = xssAdg('category');
    $post_lot_rate = xssAdg('lot-rate');
    $post_message =  xssAdg('message');
    $post_lot_step = xssAdg('lot-step');
    $post_lot_date = xssAdg('lot-date');
    $query_lot = "INSERT INTO lots (
                                    title,
                                    user_id,
                                    category_id,
                                    start_price,
                                    img,
                                    description,
                                    bet_step,
                                    completed_at
                                    )
                VALUES (?, ?, ?, ? ,? ,? ,? ,?)";
    $stmt = $db->prepare($query_lot);
    $stmt->bind_param(
        "siidssis",
        $post_lot_name,
        $user_id,
        $post_category,
        $post_lot_rate,
        $img_title,
        $post_message,
        $post_lot_step,
        $post_lot_date
    );
    $stmt_result = $stmt->execute();
    $stmt->close();
    return $stmt_result;
}
