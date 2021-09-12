<?php
function add_user(mysqli $db): bool
{
    $post_email = xssAdg('email');
    $post_name = xssAdg('name');
    $post_message = xssAdg('message');
    $post_password = xssAdg('password');
    $password_hash = password_hash($post_password, PASSWORD_DEFAULT);
    $query_user = "INSERT INTO users (email, name, password, contact) VALUES (?, ?,  ?, ?)";
    $stmt = $db->prepare($query_user);
    $stmt->bind_param(
        "ssss",
        $post_email,
        $post_name,
        $password_hash,
        $post_message
    );
    $stmt_result = $stmt->execute();
    $stmt->close();
    return $stmt_result;
}
