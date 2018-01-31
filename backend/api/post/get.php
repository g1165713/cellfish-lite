<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("GET");
request_params(["id"]);

$result = \sqlite3\query("SELECT * FROM posts WHERE id = :id", $params);
if (sizeof($result) > 0) {
    ok_with($result[0]);
} else {
    error("not_found");
}
