<?php 
$db_host = 'localhost';
$db_database = 'bookorama';
$db_username = 'gamer';
$db_password = '12345';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die ("gamer:". $db->connect_error);
}

function db_query(string $query) {
    global $db;
    $res = $db->query($query);
    if (!$res) {
        die ("An error occured: {$db->error}");
    }
    $rows = array();
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}
?>