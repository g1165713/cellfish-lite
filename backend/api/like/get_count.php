<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("GET");
request_params(["id"]);

$result = \sqlite3\query("SELECT COUNT(*) AS count FROM likes
    WHERE post = :id", $params);
ok_with($result[0]["count"]);
