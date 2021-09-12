<?php
function get_db(string $hostname, string $username, string $password, string $database): mysqli
{
    $db = new mysqli($hostname, $username, $password, $database);
    $db->set_charset('utf8');
    if ($db->connect_errno) {
        exit('Ошибка не удалось подключиться к базе данных. Повторите попытку');
    } else {
        return $db;
    }
}
