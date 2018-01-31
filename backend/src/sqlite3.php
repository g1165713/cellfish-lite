<?php namespace sqlite3;
require_once(__DIR__ . "/../prelude.php");

define("DB_PATH", __DIR__ . "/../../data.sqlite3");

function execute($sql, $params = []) {
    $database = new \SQLite3(DB_PATH, SQLITE3_OPEN_READWRITE);
    $database->enableExceptions(true);
    $resultset = _prepare_stmt($database, $sql, $params);
    $database->close();
    return [];
}

function query($sql, $params = []) {
    $database = new \SQLite3(DB_PATH, SQLITE3_OPEN_READWRITE);
    $database->enableExceptions(true);
    $resultset = _prepare_stmt($database, $sql, $params);
    $database->query($sql);

    $items = [];
    while ($item = $resultset->fetchArray(SQLITE3_ASSOC)) {
        $items[] = $item;
    }

    $resultset->finalize();
    $database->close();
    return $items;
}

function _prepare_stmt($database, $sql, $params) {
    if ($stmt = $database->prepare($sql)) {
        foreach ($params as $key => $value) {
            if (!$stmt->bindValue(":" . $key, $value)) {
                die("Fatal Error: failed to bind $value to :$key");
            }
        }
    } else {
        die("Fatal Error: failed to prepare statement $sql");
    }
    return $stmt->execute();
}
