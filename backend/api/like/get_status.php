<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("GET");
request_params(["id"]);
\util\member_only();

$params["username"] = \util\login_as();
$result = \sqlite3\query("SELECT * FROM likes
    WHERE post = :id AND username = :username", $params);
ok_with(sizeof($result) > 0);
