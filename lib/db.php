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
    if (is_bool($res)) {
        return $res;
    } else {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}

function db_list(string $query) {
    return db_query($query);
}

function db_single(string $query) {
    return db_query($query)[0];
}

function array_map_assoc($array){
    $r = array();
    foreach ($array as $key=>$value)
      $r[$key] = "$key='$value'";
    return $r;
}

function db_update(string $model, string $identifier, string $id, array $data) {
    $r = array();
    foreach ($data as $key=>$value) {
        $r[$key] = "$key='$value'";
    }
    return db_query("UPDATE $model SET " . implode(' , ', $r) . "WHERE {$identifier}='{$id}'");
}

function db_insert(string $model, array $data) {
    // return db_query("INSERT INTO $model SET " . )
}
?>