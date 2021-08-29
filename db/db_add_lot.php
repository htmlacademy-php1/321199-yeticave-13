<?php

    /**
     * Функция добавления лота в базу данных
     * @param mysqli $db
     */

    function add_lot(mysqli $db, string $img_title)
    {
        $user_id = rand(0, 6);
        $query_lot = "INSERT INTO lots (title , user_id, category_id,  start_price , img , description , bet_step, completed_at) VALUES (?, ?,  ?, ? ,? ,? ,? ,?)";
        $stmt = $db->prepare($query_lot);
        $stmt->bind_param("siidssis", $_POST['lot-name'], $user_id, $_POST['category'], $_POST['lot-rate'], $img_title , $_POST['message'], $_POST['lot-step'], $_POST['lot-date']);
        $stmt_result = $stmt->execute();
        $stmt->close();
        return $stmt_result;
    }
