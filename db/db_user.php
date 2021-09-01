<?php
    function add_user(mysqli $db){
        $password_hash = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $query_user = "INSERT INTO users (email, name, password, contact) VALUES (?, ?,  ?, ?)";
        $stmt = $db->prepare($query_user);
        $stmt->bind_param("ssss", $_POST['email'],$_POST['name'], $password_hash, $_POST['message']);
        $stmt_result = $stmt->execute();
        $stmt->close();
        return $stmt_result;
    }
