<?php 
$db_host = 'localhost';
$db_database = 'bookorama';
$db_username = 'gamer';
$db_password = '12345';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die ("Error while connecting:". $db->connect_error);
}

$db->autocommit(FALSE);

function db_query(string $query, ?array $params, ?string $types) {
    global $db;
    $statement = $db->prepare($query);
    if ($params && $types) {
        $statement->bind_param($types, ...$params);
    }
    $statement->execute();
    $res = $statement->get_result();
    if (is_bool($res)) {
        return !$statement->affected_rows == -1;
    } else {
        if (!$res) {
            die ("An error occured: {$db->error}");
        }
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}

function db_list(string $query) {
    return db_query($query, null, null);
}

function db_single(string $query) {
    return db_query($query, null, null)[0];
}

function db_update(string $model, string $identifier, string $id, array $data) {
    global $db;
    $r = array();
    foreach ($data as $key=>$value) {
        $r[] = "$key=?";
    }
    $res = db_query("UPDATE {$model} SET " . implode(' , ', $r) . " WHERE {$identifier}='{$id}'", array_values($data), implode("", array_fill(0, count($data), "s")));
    if (!$res) {
        $db->rollback();
    } else {
        $db->commit();
    }
}

function db_insert(string $model, array $data) {
    global $db;
    $res = db_query("INSERT INTO {$model} (" . implode(',', array_keys($data)) . ") VALUES (" . implode(' , ', array_fill(0, count($data), "?")) . ")", array_values($data), implode("", array_fill(0, count($data), "s")));
    if (!$res) {
        $db->rollback();
    } else {
        $db->commit();
    }
}

// function db_query(string $query) {
//     global $db;
//     $res = $db->query($query);
//     if (!$res) {
//         die ("An error occured: {$db->error}");
//     }
//     if (is_bool($res)) {
//         return $res;
//     } else {
//         $rows = array();
//         while ($row = $res->fetch_assoc()) {
//             $rows[] = $row;
//         }
//         return $rows;
//     }
// }
?>
